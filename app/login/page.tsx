import { loginAction } from "./actions";

export default async function LoginPage({ searchParams }: { searchParams: Promise<{ error?: string }> }) {
  const params = await searchParams;
  const message = params.error === "invalid" ? "Username atau password salah." : params.error === "missing" ? "Username dan password wajib diisi." : "";

  return (
    <main style={{ minHeight: "100vh", display: "grid", placeItems: "center", padding: 24 }}>
      <section style={{ width: "100%", maxWidth: 420, background: "#fff", borderRadius: 20, padding: 32, boxShadow: "0 12px 40px rgba(0,0,0,.08)" }}>
        <p style={{ margin: 0, fontWeight: 700, color: "#2563eb" }}>KOPERASI</p>
        <h1>Masuk ke sistem</h1>
        <p style={{ color: "#667085" }}>Satu halaman login untuk anggota, admin, dan master admin.</p>
        {message && <div style={{ padding: 12, borderRadius: 10, background: "#fee4e2", color: "#b42318", marginBottom: 16 }}>{message}</div>}
        <form action={loginAction} style={{ display: "grid", gap: 14 }}>
          <label>Username<input name="username" autoComplete="username" required style={{ display: "block", width: "100%", padding: 12, marginTop: 6, border: "1px solid #d0d5dd", borderRadius: 10 }} /></label>
          <label>Password<input type="password" name="password" autoComplete="current-password" required style={{ display: "block", width: "100%", padding: 12, marginTop: 6, border: "1px solid #d0d5dd", borderRadius: 10 }} /></label>
          <button type="submit" style={{ padding: 12, border: 0, borderRadius: 10, background: "#172033", color: "#fff", fontWeight: 700 }}>Login</button>
        </form>
      </section>
    </main>
  );
}