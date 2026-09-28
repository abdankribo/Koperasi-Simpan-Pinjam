"use server";

import { redirect } from "next/navigation";
import bcrypt from "bcryptjs";
import { prisma } from "@/lib/prisma";
import { createSession } from "@/lib/auth";

async function validPassword(input: string, stored: string) {
  if (stored.startsWith("$2")) return bcrypt.compare(input, stored);
  return input === stored;
}

export async function loginAction(formData: FormData) {
  const username = String(formData.get("username") || "").trim();
  const password = String(formData.get("password") || "");

  if (!username || !password) redirect("/login?error=missing");

  // Only active members may create a member session. An inactive member
  // can still be retained for historical transactions without access.
  const anggota = await prisma.anggota.findFirst({
    where: { usernameUser: username, statusAnggota: "Aktif" },
  });

  if (anggota?.passwordUser && await validPassword(password, anggota.passwordUser)) {
    if (!anggota.passwordUser.startsWith("$2")) {
      await prisma.anggota.update({
        where: { id: anggota.id },
        data: { passwordUser: await bcrypt.hash(password, 12) },
      });
    }
    await createSession(String(anggota.id), "anggota");
    redirect("/anggota");
  }

  const admin = await prisma.admin.findFirst({ where: { usernameAdmin: username } });
  if (admin && await validPassword(password, admin.passwordAdmin)) {
    if (!admin.passwordAdmin.startsWith("$2")) {
      await prisma.admin.update({
        where: { idAdmin: admin.idAdmin },
        data: { passwordAdmin: await bcrypt.hash(password, 12) },
      });
    }
    await createSession(String(admin.idAdmin), "admin");
    redirect("/admin");
  }

  const master = await prisma.masterAdmin.findFirst({ where: { usernameMaster: username } });
  if (master && await validPassword(password, master.passwordMaster)) {
    if (!master.passwordMaster.startsWith("$2")) {
      await prisma.masterAdmin.update({
        where: { idMaster: master.idMaster },
        data: { passwordMaster: await bcrypt.hash(password, 12) },
      });
    }
    await createSession(String(master.idMaster), "master");
    redirect("/master-admin");
  }

  redirect("/login?error=invalid");
}