import { cookies } from "next/headers";
import { jwtVerify, SignJWT } from "jose";

export type Role = "anggota" | "admin" | "master";

const secret = new TextEncoder().encode(process.env.AUTH_SECRET || "development-only-secret-change-me");

export async function createSession(userId: string, role: Role) {
  const token = await new SignJWT({ userId, role })
    .setProtectedHeader({ alg: "HS256" })
    .setIssuedAt()
    .setExpirationTime("8h")
    .sign(secret);

  const store = await cookies();
  store.set("koperasi_session", token, {
    httpOnly: true,
    sameSite: "lax",
    secure: process.env.NODE_ENV === "production",
    path: "/",
    maxAge: 60 * 60 * 8
  });
}

export async function getSession() {
  const token = (await cookies()).get("koperasi_session")?.value;
  if (!token) return null;
  try {
    const { payload } = await jwtVerify(token, secret);
    return { userId: String(payload.userId), role: payload.role as Role };
  } catch {
    return null;
  }
}

export async function clearSession() {
  (await cookies()).delete("koperasi_session");
}