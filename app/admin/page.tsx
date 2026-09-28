import Link from "next/link";
import { getSession } from "@/lib/auth";
import { prisma } from "@/lib/prisma";
import { redirect } from "next/navigation";

export default async function AdminPage(){
 const s=await getSession(); if(!s||s.role!=="admin") redirect("/login");
 const [anggota,simpanan,pinjaman]=await Promise.all([prisma.anggota.count(),prisma.simpanan.count(),prisma.pinjaman.count()]);
 return <main className="page"><div className="hero"><div><span className="eyebrow">ADMINISTRATOR</span><h1>Dashboard Koperasi</h1><p>Kelola anggota dan aktivitas keuangan koperasi dari satu tempat.</p></div><a className="btn light" href="/logout">Keluar</a></div><div className="stats"><div className="stat"><small>Anggota</small><strong>{anggota}</strong><Link href="/admin/anggota">Lihat data →</Link></div><div className="stat"><small>Simpanan</small><strong>{simpanan}</strong><Link href="/admin/simpanan">Buka modul →</Link></div><div className="stat"><small>Pinjaman</small><strong>{pinjaman}</strong><Link href="/admin/pinjaman">Buka modul →</Link></div></div><section className="card"><h2>Modul administrasi</h2><div className="grid"><Link className="module" href="/admin/anggota"><b>👥 Data Anggota</b><span>Kelola identitas dan status anggota.</span></Link><Link className="module" href="/admin/simpanan"><b>💰 Simpanan</b><span>Pantau saldo simpanan berdasarkan jenis.</span></Link><Link className="module" href="/admin/pinjaman"><b>📄 Pinjaman</b><span>Pantau pokok, jasa dan angsuran.</span></Link><Link className="module" href="/master-admin"><b>⚙️ Master Admin</b><span>Kelola unit dan kelompok.</span></Link></div></section></main>;
}