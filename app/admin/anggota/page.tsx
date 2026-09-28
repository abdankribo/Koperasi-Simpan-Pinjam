import Link from "next/link";
import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

export default async function AnggotaAdminPage() {
  const s=await getSession(); if(!s||s.role!=="admin") redirect("/login");
  const rows=await prisma.anggota.findMany({orderBy:{id:"asc"}});
  return <main className="page"><div className="top"><div><span className="eyebrow">DATA ANGGOTA</span><h1>Anggota Koperasi</h1><p>Kelola identitas dan status anggota.</p></div><Link className="btn" href="/admin">Kembali</Link></div><div className="card"><table><thead><tr><th>No.</th><th>Nomor</th><th>Nama</th><th>Unit</th><th>Status</th><th>Kontak</th></tr></thead><tbody>{rows.map((x,i)=><tr key={x.id}><td>{i+1}</td><td>{x.nomorAnggota||"-"}</td><td>{x.nama||"-"}</td><td>{x.unit||"-"}</td><td><span className="badge">{x.statusAnggota||"Aktif"}</span></td><td>{x.nomorTelepon||x.email||"-"}</td></tr>)}</tbody></table></div></main>;
}