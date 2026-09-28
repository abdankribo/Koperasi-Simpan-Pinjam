import Link from "next/link";
import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

export default async function SimpananAdminPage() {
 const s=await getSession(); if(!s||s.role!=="admin") redirect("/login");
 const rows=await prisma.simpanan.findMany({orderBy:{idSmp:"desc"}});
 const total=rows.reduce((a,x)=>a+Number(x.spokok||0)+Number(x.swajib||0)+Number(x.ssukarela||0)+Number(x.shariraya||0)+Number(x.skhusus||0),0);
 return <main className="page"><div className="top"><div><span className="eyebrow">KEUANGAN</span><h1>Simpanan</h1><p>Ringkasan simpanan seluruh anggota.</p></div><Link className="btn" href="/admin">Kembali</Link></div><div className="stats"><div className="stat"><small>Total transaksi</small><strong>{rows.length}</strong></div><div className="stat"><small>Total nilai</small><strong>Rp {total.toLocaleString("id-ID")}</strong></div></div><div className="card"><table><thead><tr><th>Anggota</th><th>Unit</th><th>Pokok</th><th>Wajib</th><th>Sukarela</th><th>Hari Raya</th><th>Khusus</th></tr></thead><tbody>{rows.map(x=><tr key={x.idSmp}><td>{x.namaAnggota||x.nomorAnggota||"-"}</td><td>{x.unit||"-"}</td><td>Rp {Number(x.spokok||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.swajib||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.ssukarela||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.shariraya||0).toLocaleString("id-ID")}</td><td>Rp {Number(x.skhusus||0).toLocaleString("id-ID")}</td></tr>)}</tbody></table></div></main>;
}