import Link from "next/link";

export default function HomePage() {
  return (
    <main style={{ minHeight: "100vh", display: "grid", placeItems: "center", padding: 24 }}>
      <section style={{ maxWidth: 760, width: "100%", background: "#fff", borderRadius: 24, padding: 40, boxShadow: "0 12px 40px rgba(0,0,0,.08)" }}>
        <p style={{ margin: 0, fontWeight: 700, color: "#2563eb" }}>KOPERASI SIMPAN PINJAM</p>
        <h1 style={{ fontSize: "clamp(2rem, 5vw, 4rem)", margin: "12px 0" }}>Platform koperasi sedang dimigrasikan ke Next.js.</h1>
        <p style={{ lineHeight: 1.7, color: "#526071" }}>
          Fondasi Next.js, TypeScript, Prisma, dan autentikasi sedang disiapkan tanpa menghilangkan modul dan data dari aplikasi PHP lama.
        </p>
        <Link href="/login" style={{ display: "inline-block", marginTop: 16, padding: "12px 18px", borderRadius: 12, background: "#172033", color: "#fff", fontWeight: 700 }}>
          Masuk
        </Link>
      </section>
    </main>
  );
}