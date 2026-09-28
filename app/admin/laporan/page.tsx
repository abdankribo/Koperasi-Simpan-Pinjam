import Link from "next/link";
import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

async function safeQuery<T>(query: Promise<T>, fallback: T): Promise<T> {
  try {
    return await query;
  } catch (error) {
    console.error("[LAPORAN] Database query failed:", error);
    return fallback;
  }
}

export default async function Page() {
  const session = await getSession();

  if (!session || session.role !== "admin") {
    redirect("/login");
  }

  const [sim, pin, bank, beban, eku, kew] = await Promise.all([
    safeQuery(prisma.simpanan.findMany(), []),
    safeQuery(prisma.pinjaman.findMany(), []),
    safeQuery(prisma.bankRecord.findMany(), []),
    safeQuery(prisma.beban.findMany(), []),
    safeQuery(prisma.ekuitas.findMany(), []),
    safeQuery(prisma.kewajiban.findMany(), []),
  ]);

  const totalSim = sim.reduce(
    (total, row) =>
      total +
      Number(row.spokok || 0) +
      Number(row.swajib || 0) +
      Number(row.ssukarela || 0) +
      Number(row.shariraya || 0) +
      Number(row.skhusus || 0),
    0
  );

  const totalPin = pin.reduce(
    (total, row) =>
      total +
      Number(row.pinjamanPokok || 0) +
      Number(row.pinjamanKhususPokok || 0),
    0
  );

  const masuk = bank.reduce((total, row) => total + Number(row.uangMasuk || 0), 0);
  const keluar = bank.reduce((total, row) => total + Number(row.uangKeluar || 0), 0);

  const totalBeban = beban.reduce(
    (total, row) =>
      total +
      Number(row.administrasi || 0) +
      Number(row.pendapatanLain || 0) +
      Number(row.rapatAnggota || 0) +
      Number(row.insentif || 0) +
      Number(row.honorKetuaKel || 0) +
      Number(row.thr || 0) +
      Number(row.atk || 0) +
      Number(row.transportasi || 0) +
      Number(row.sisihGedung || 0) +
      Number(row.sisihPiutang || 0) +
      Number(row.susutInventaris || 0) +
      Number(row.konsumsi || 0) +
      Number(row.rawatAset || 0) +
      Number(row.bebanLain || 0) +
      Number(row.pajakBadan || 0),
    0
  );

  const eq = eku.reduce(
    (total, row) =>
      total +
      Number(row.hibah || 0) +
      Number(row.modal || 0) +
      Number(row.resiko || 0),
    0
  );

  const kw = kew.reduce(
    (total, row) =>
      total +
      Number(row.sewaGedung || 0) +
      Number(row.utangPajak || 0) +
      Number(row.danaPengurusPengawas || 0) +
      Number(row.danaPendidikan || 0) +
      Number(row.danaKaryawan || 0) +
      Number(row.danaSosial || 0),
    0
  );

  const rupiah = (value: number) =>
    `Rp ${value.toLocaleString("id-ID")}`;

  return (
    <main className="page">
      <div className="top">
        <div>
          <span className="eyebrow">KEUANGAN</span>
          <h1>Laporan & Neraca</h1>
          <p>Ringkasan data keuangan dari database koperasi.</p>
        </div>
        <Link className="btn" href="/admin">
          Dashboard
        </Link>
      </div>

      <div className="stats">
        <div className="stat">
          <small>Total simpanan</small>
          <strong>{rupiah(totalSim)}</strong>
        </div>
        <div className="stat">
          <small>Total pinjaman</small>
          <strong>{rupiah(totalPin)}</strong>
        </div>
        <div className="stat">
          <small>Kas/bank bersih</small>
          <strong>{rupiah(masuk - keluar)}</strong>
        </div>
      </div>

      <div className="grid">
        <section className="card">
          <h2>Aset & Ekuitas</h2>
          <p>
            Ekuitas: <b>{rupiah(eq)}</b>
          </p>
          <p>
            Simpanan anggota: <b>{rupiah(totalSim)}</b>
          </p>
          <p>
            Pinjaman: <b>{rupiah(totalPin)}</b>
          </p>
        </section>

        <section className="card">
          <h2>Kewajiban & Beban</h2>
          <p>
            Kewajiban: <b>{rupiah(kw)}</b>
          </p>
          <p>
            Beban tercatat: <b>{rupiah(totalBeban)}</b>
          </p>
          <p>
            Bank masuk: <b>{rupiah(masuk)}</b>
          </p>
          <p>
            Bank keluar: <b>{rupiah(keluar)}</b>
          </p>
        </section>
      </div>
    </main>
  );
}
