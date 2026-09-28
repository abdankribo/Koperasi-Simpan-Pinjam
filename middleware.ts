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

  // Master Admin uses the complete Admin interface while keeping
  // /master-admin in the browser URL.
  if (pathname === "/master-admin" || pathname.startsWith("/master-admin/")) {
    if (role !== "master") {
      return NextResponse.redirect(new URL("/login", request.url));
    }

    const target = pathname.replace(/^\/master-admin(?=\/|$)/, "") || "/";
    const url = request.nextUrl.clone();
    url.pathname = target === "/" ? "/admin" : `/admin${target}`;
    return NextResponse.rewrite(url);
  }

  // Any Admin URL reached by a Master is redirected back to the
  // Master namespace, so navigation and server-action redirects stay
  // under /master-admin instead of exposing /admin.
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
