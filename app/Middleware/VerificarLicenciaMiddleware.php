<?php

namespace App\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Utils\ManejoData;

use App\Models\License;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class VerificarLicenciaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if ($user) {
            $license = License::where('id', Auth::user()->license_id)->first();

            if (!$license) {
                $devolucion = ManejoData::armarDevolucion(403, false, 'Licencia inválida o no registrada', null, 'Licencia');
                return response()->json($devolucion, $devolucion['code']);
            }

            if ($license->status === 'inactive') {
                $devolucion = ManejoData::armarDevolucion(403, false, 'La licencia está inactiva', null, 'Licencia');
                return response()->json($devolucion, $devolucion['code']);
            }

            if ($license->status === 'expired') {
                $devolucion = ManejoData::armarDevolucion(403, false, 'La licencia está marcada como vencida', null, 'Licencia');
                return response()->json($devolucion, $devolucion['code']);
            }

            if ($license->start_date > now()) {
                $devolucion = ManejoData::armarDevolucion(403, false, 'La licencia aún no ha comenzado; su período de vigencia inicia ' . $license->start_date, null, 'Licencia');
                return response()->json($devolucion, $devolucion['code']);
            }

            if ($license->end_date !== null && $license->end_date < now()) {
                if ($license->status !== 'expired') {
                    $license->status = 'expired';
                    $license->save();
                }

                $devolucion = ManejoData::armarDevolucion(403, false, 'La licencia ha vencido', null, 'Licencia');
                return response()->json($devolucion, $devolucion['code']);
            }

            if ($license->end_date !== null) {
                $endDate = Carbon::parse($license->end_date);
                $eightDaysBefore = $endDate->copy()->subDays(8);
                if (now()->between($eightDaysBefore, $endDate)) {
                    //enviar correo o notificacion al fron de que va ha vencer la lisencia
                    Log::info('esta en el rando de vencerse');
                }
            }
        }

        return $next($request);
    }
}
