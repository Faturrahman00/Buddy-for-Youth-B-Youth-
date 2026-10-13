<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     * Memastikan pengguna yang sudah login memiliki role yang sesuai.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles  Role yang diizinkan (bisa lebih dari satu)
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (! Auth::check()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        $user = Auth::user();

        if (! in_array($user->role, $roles)) {
            // Redirect ke dashboard sesuai role yang dimiliki
            return redirect()->route($this->dashboardForRole($user->role))
                ->withErrors(['email' => 'Anda tidak memiliki akses ke halaman tersebut.']);
        }

        return $next($request);
    }

    /**
     * Kembalikan nama route dashboard berdasarkan role.
     */
    private function dashboardForRole(string $role): string
    {
        return match ($role) {
            'admin'    => 'admin.dashboard',
            'psikolog' => 'psikolog.dashboard',
            default    => 'dashboard_siswa',
        };
    }
}
