import { NextRequest, NextResponse } from "next/server";
import { jwtVerify } from "jose";

const secret = new TextEncoder().encode(
  process.env.AUTH_SECRET || "development-only-secret-change-me"
);

async function getRole(request: NextRequest) {
  const token = request.cookies.get("koperasi_session")?.value;
  if (!token) return null;

  try {
    const { payload } = await jwtVerify(token, secret);
    return payload.role === "master" || payload.role === "admin"
      ? payload.role
      : null;
  } catch {
    return null;
  }
}

export async function middleware(request: NextRequest) {
  const { pathname } = request.nextUrl;
  const role = await getRole(request);

  // Master keeps its dedicated dashboard/navigation. Only the
  // "Administrasi" area reuses the full Admin module internally.
  if (pathname === "/master-admin" || pathname.startsWith("/master-admin/")) {
    if (role !== "master") {
      return NextResponse.redirect(new URL("/login", request.url));
    }

    if (pathname === "/master-admin/administrasi" || pathname.startsWith("/master-admin/administrasi/")) {
      const suffix = pathname.slice("/master-admin/administrasi".length) || "";
      const url = request.nextUrl.clone();
      url.pathname = suffix ? `/admin${suffix}` : "/admin";
      return NextResponse.rewrite(url);
    }

    return NextResponse.next();
  }

  // If a Master follows an existing Admin link/action, keep the
  // browser inside the Master Admin namespace.
  if (pathname === "/admin" || pathname.startsWith("/admin/")) {
    if (role === "master") {
      const suffix = pathname.slice("/admin".length);
      const url = request.nextUrl.clone();
      url.pathname = `/master-admin/administrasi${suffix}`;
      return NextResponse.redirect(url);
    }
  }

  return NextResponse.next();
}

export const config = {
  matcher: ["/admin/:path*", "/master-admin/:path*"],
};
