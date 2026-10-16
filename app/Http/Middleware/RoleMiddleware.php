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
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        // Cari user dari guard manapun yang sedang aktif
        $user = Auth::guard('admin')->user() 
            ?? Auth::guard('psikolog')->user() 
            ?? Auth::guard('siswa')->user() 
            ?? Auth::user();

        if (! $user) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Silakan login terlebih dahulu.']);
        }

        $userRole = $user->role ?? 'siswa';

        if (! in_array($userRole, $roles)) {
            $targetRoute = $this->dashboardForRole($userRole);
            if ($request->routeIs($targetRoute)) {
                abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
            }

            return redirect()->route($targetRoute)
                ->withErrors(['email' => 'Anda tidak memiliki akses ke halaman tersebut.']);
        }

        // Set guard aktif agar Auth::user() di Controller dan Blade merujuk ke model yang tepat
        if (Auth::guard('admin')->check()) {
            Auth::shouldUse('admin');
        } elseif (Auth::guard('psikolog')->check()) {
            Auth::shouldUse('psikolog');
        } elseif (Auth::guard('siswa')->check()) {
            Auth::shouldUse('siswa');
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
