const { PrismaClient } = require("@prisma/client");
const bcrypt = require("bcryptjs");

const prisma = new PrismaClient();

async function ensureAdmin() {
  const username = "admin-demo";
  const existing = await prisma.admin.findFirst({ where: { usernameAdmin: username } });
  if (existing) return console.log(`Admin demo "${username}" sudah ada.`);
  await prisma.admin.create({
    data: {
      usernameAdmin: username,
      passwordAdmin: await bcrypt.hash("admin123", 12),
    },
  });
  console.log("Admin demo dibuat: admin-demo");
}

async function ensureMember() {
  const username = "anggota-demo";
  const nomor = "AGT-DEMO-001";
  const existing = await prisma.anggota.findFirst({
    where: { OR: [{ usernameUser: username }, { nomorAnggota: nomor }] },
  });
  if (existing) return console.log(`Anggota demo "${username}" sudah ada.`);
  await prisma.anggota.create({
    data: {
      nomorAnggota: nomor,
      koperasiUser: "DINKOPUM",
      nama: "Anggota Demo",
      usernameUser: username,
      passwordUser: await bcrypt.hash("anggota123", 12),
      jabatanAnggota: "Anggota",
      unit: "Koperasi",
      alamat: "Data Demo",
      nomorTelepon: "080000000000",
      email: "anggota-demo@example.com",
      jenisKelamin: "Laki-Laki",
      statusAnggota: "Aktif",
      lastUpdate: Math.floor(Date.now() / 1000),
    },
  });
  console.log("Anggota demo dibuat: anggota-demo");
}

async function ensureGroups() {
  const masterGroup = await prisma.masterKelompok.findFirst({
    where: { namaKelompok: "Kelompok Demo" },
  });
  if (!masterGroup) {
    await prisma.masterKelompok.create({
      data: { usernameMaster: "master", namaKelompok: "Kelompok Demo" },
    });
    console.log("Master Kelompok demo dibuat: Kelompok Demo");
  } else {
    console.log("Master Kelompok demo sudah ada.");
  }

  const listGroup = await prisma.listKelompok.findFirst({
    where: { namaKelompok: "Kelompok Demo" },
  });
  if (!listGroup) {
    await prisma.listKelompok.create({ data: { namaKelompok: "Kelompok Demo" } });
    console.log("Kelompok koperasi demo dibuat: Kelompok Demo");
  } else {
    console.log("Kelompok koperasi demo sudah ada.");
  }
}

async function main() {
  // Master account is handled by the existing seed-master script.
  await ensureAdmin();
  await ensureMember();
  await ensureGroups();
  console.log("Seed demo selesai. Master Admin gunakan: master / master123.");
}

main()
  .catch((error) => {
    console.error("Gagal membuat data demo:", error);
    process.exitCode = 1;
  })
  .finally(async () => prisma.$disconnect());
