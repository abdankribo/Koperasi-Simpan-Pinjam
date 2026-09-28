import Link from "next/link";
import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

export default async function PinjamanAdminPage() {
 const s=await getSession(); if(!s||s.role!=="admin") redirect("/login");
 const rows=await prisma.pinjaman.findMany({orderBy:{idPinjaman:"desc"}});
 const total=rows.reduce((a,x)=>a+Number(x.pinjamanPokok||0)+Number(x.pinjamanKhususPokok||0),0);
 return <main className="page"><div className="top"><div><span className="eyebrow">KEUANGAN</span><h1>Pinjaman</h1><p>Monitoring pokok pinjaman dan angsuran anggota.</p></div><Link className="btn" href="/admin">Kembali</Link></div><div className="stats"><div className="stat"><small>Total pinjaman</small><strong>{rows.length}</strong></div><div className="stat"><small>Pokok berjalan</small><strong>Rp {total.toLocaleString("id-ID")}</strong></div></div><div className="card"><table><thead><tr><th>Anggota</th><th>Unit</th><th>Pokok</th><th>Jasa</th><th>Pokok khusus</th><th>Angsuran pokok</th><th>Angsuran jasa</th></tr></thead><tbody>{rows.map(x=><tr key={x.idPinjaman}><td>{x.namaAnggota}</td><td>{x.unit||"-"}</td><td>Rp {Number(x.pinjamanPokok||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.pinjamanJasa||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.pinjamanKhususPokok||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.angsuranPokok||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.angsuranJasa||0).toLocaleString("id-ID")}</td></tr>)}</tbody></table></div></main>;
}