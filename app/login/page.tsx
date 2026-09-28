export default function LoginPage() {
  return (
    <main style={{ minHeight: "100vh", display: "grid", placeItems: "center", padding: 24 }}>
      <section style={{ width: "100%", maxWidth: 420, background: "#fff", borderRadius: 20, padding: 32, boxShadow: "0 12px 40px rgba(0,0,0,.08)" }}>
        <h1 style={{ marginTop: 0 }}>Login</h1>
        <p style={{ color: "#667085" }}>Halaman login Next.js — autentikasi 3 level akan dipindahkan pada tahap berikutnya.</p>
        <form style={{ display: "grid", gap: 14 }}>
          <label>Username<input name="username" required style={{ width: "100%", padding: 12, marginTop: 6, border: "1px solid #d0d5dd", borderRadius: 10 }} /></label>
          <label>Password<input type="password" name="password" required style={{ width: "100%", padding: 12, marginTop: 6, border: "1px solid #d0d5dd", borderRadius: 10 }} /></label>
          <button type="submit" style={{ padding: 12, border: 0, borderRadius: 10, background: "#172033", color: "#fff", fontWeight: 700 }}>Login</button>
        </form>
      </section>
    </main>
  );
}