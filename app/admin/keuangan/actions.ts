"use server";
import { prisma } from "@/lib/prisma";
import { getSession } from "@/lib/auth";
import { redirect } from "next/navigation";

async function guard(){const s=await getSession();if(!s||(s.role!=="admin"&&s.role!=="master"))redirect("/login");}
const n=(v:FormDataEntryValue|null)=>Number(v||0);
const d=(v:FormDataEntryValue|null)=>v?new Date(String(v)):new Date();

export async function createBank(fd:FormData){await guard();await prisma.bankRecord.create({data:{uangMasuk:n(fd.get("masuk")),uangKeluar:n(fd.get("keluar")),keterangan:String(fd.get("keterangan")||"Transaksi"),tanggal:d(fd.get("tanggal"))}});redirect("/admin/keuangan");}
export async function deleteBank(fd:FormData){await guard();await prisma.bankRecord.delete({where:{idBankRec:n(fd.get("id"))}});redirect("/admin/keuangan");}
export async function createBeban(fd:FormData){await guard();const keys=["administrasi","pendapatanLain","rapatAnggota","insentif","honorKetuaKel","thr","atk","transportasi","sisihGedung","sisihPiutang","susutInventaris","konsumsi","rawatAset","bebanLain","pajakBadan"] as const;const data:any={tahun:d(fd.get("tahun"))};for(const k of keys)data[k]=n(fd.get(k));await prisma.beban.create({data});redirect("/admin/keuangan");}
export async function deleteBeban(fd:FormData){await guard();await prisma.beban.delete({where:{idBeban:n(fd.get("id"))}});redirect("/admin/keuangan");}
export async function createAset(fd:FormData){await guard();await prisma.asetTetap.create({data:{inventaris:n(fd.get("inventaris")),penyusutan:n(fd.get("penyusutan")),tahun:d(fd.get("tahun"))}});redirect("/admin/keuangan");}
export async function deleteAset(fd:FormData){await guard();await prisma.asetTetap.delete({where:{idAsetTetap:n(fd.get("id"))}});redirect("/admin/keuangan");}
export async function createEkuitas(fd:FormData){await guard();await prisma.ekuitas.create({data:{hibah:n(fd.get("hibah")),modal:n(fd.get("modal")),resiko:n(fd.get("resiko")),tahun:n(fd.get("tahun"))}});await prisma.ekuitasRecord.create({data:{hibahRec:n(fd.get("hibah")),modalRec:n(fd.get("modal")),resikoRec:n(fd.get("resiko")),tanggalEkuitas:new Date()}});redirect("/admin/keuangan");}
export async function deleteEkuitas(fd:FormData){await guard();await prisma.ekuitas.delete({where:{idEkuitas:n(fd.get("id"))}});redirect("/admin/keuangan");}
export async function createKewajiban(fd:FormData){await guard();await prisma.kewajiban.create({data:{sewaGedung:n(fd.get("sewa")),utangPajak:n(fd.get("pajak")),danaPengurusPengawas:n(fd.get("pengurus")),danaPendidikan:n(fd.get("pendidikan")),danaKaryawan:n(fd.get("karyawan")),danaSosial:n(fd.get("sosial")),tanggalKewajiban:d(fd.get("tanggal"))}});redirect("/admin/keuangan");}
export async function deleteKewajiban(fd:FormData){await guard();await prisma.kewajiban.delete({where:{idKewajiban:n(fd.get("id"))}});redirect("/admin/keuangan");}
export async function createShu(fd:FormData){await guard();await prisma.shu.create({data:{cadanganModal:n(fd.get("cadanganModal")),cadanganResiko:n(fd.get("cadanganResiko")),anggotaSimpanan:n(fd.get("anggotaSimpanan")),anggotaPinjaman:n(fd.get("anggotaPinjaman")),danaPp:n(fd.get("danaPp")),danaPendidikan:n(fd.get("danaPendidikan")),danaKaryawan:n(fd.get("danaKaryawan")),danaSosial:n(fd.get("danaSosial")),tahun:n(fd.get("tahun"))}});redirect("/admin/keuangan");}
export async function deleteShu(fd:FormData){await guard();await prisma.shu.delete({where:{idShu:n(fd.get("id"))}});redirect("/admin/keuangan");}
