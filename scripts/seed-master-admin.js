const { PrismaClient } = require("@prisma/client");
const bcrypt = require("bcryptjs");

const prisma = new PrismaClient();

async function main() {
  const username = (process.env.MASTER_USERNAME || "master").trim();
  const password = process.env.MASTER_PASSWORD || "master123";
  const unit = (process.env.MASTER_UNIT || "Koperasi").trim();

  if (!username || password.length < 6) {
    throw new Error("MASTER_USERNAME wajib diisi dan MASTER_PASSWORD minimal 6 karakter.");
  }

  const existing = await prisma.masterAdmin.findFirst({
    where: { usernameMaster: username },
  });

  if (existing) {
    console.log(`Akun Master Admin "${username}" sudah ada (id=${existing.idMaster}). Tidak ada perubahan.`);
    return;
  }

  const passwordHash = await bcrypt.hash(password, 12);

  const master = await prisma.masterAdmin.create({
    data: {
      usernameMaster: username,
      passwordMaster: passwordHash,
      unit: unit || "Koperasi",
    },
  });

  console.log(`Master Admin berhasil dibuat: username="${master.usernameMaster}", id=${master.idMaster}, unit="${master.unit}".`);
  console.log("Password tidak ditampilkan demi keamanan.");
}

main()
  .catch((error) => {
    console.error("Gagal membuat Master Admin:", error);
    process.exitCode = 1;
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
