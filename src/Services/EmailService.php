<?php

namespace App\Services;

use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Part\DataPart;

class EmailService
{
    private Mailer $mailer;

    public function __construct()
    {
        // Para desarrollo usamos un transporte dummy
        // En producción cambiar por SMTP real
        $transport = Transport::fromDsn('smtp://localhost');
        $this->mailer = new Mailer($transport);
    }

    /**
     * Envía un email con reporte adjunto
     * @param string $destinatario
     * @param string $asunto
     * @param string $contenido
     * @param string|null $adjuntoPdf
     * @param string|null $nombreAdjunto
     * @return bool
     */
    public function enviarReporte(
        string $destinatario, 
        string $asunto, 
        string $contenido, 
        ?string $adjuntoPdf = null, 
        ?string $nombreAdjunto = null
    ): bool {
        try {
            $email = (new Email())
                ->from('admin@empresa.com')
                ->to($destinatario)
                ->subject($asunto)
                ->html($contenido);

            if ($adjuntoPdf && $nombreAdjunto) {
                $email->addPart(new DataPart($adjuntoPdf, $nombreAdjunto, 'application/pdf'));
            }

            // En desarrollo, simular envío exitoso
            // $this->mailer->send($email);
            
            // Log del email para desarrollo
            $this->logEmail($destinatario, $asunto, $contenido, $nombreAdjunto);
            
            return true;
        } catch (\Exception $e) {
            error_log("Error enviando email: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Genera contenido HTML para email de reporte de empleados
     * @param array $estadisticas
     * @return string
     */
    public function generarContenidoEmpleados(array $estadisticas): string
    {
        $html = "
        <html>
        <body style='font-family: Arial, sans-serif;'>
            <h2 style='color: #333;'>Reporte de Empleados</h2>
            <p>Estimado/a,</p>
            <p>Adjunto encontrará el reporte de empleados generado el " . date('d/m/Y H:i:s') . ".</p>
            
            <h3>Resumen Ejecutivo:</h3>
            <ul>";
        
        if (isset($estadisticas['departamento_top'])) {
            $deptoTop = $estadisticas['departamento_top'];
            $promedio = number_format($deptoTop['promedio'], 0, ',', '.');
            $html .= "<li><strong>Departamento con mayor promedio salarial:</strong> {$deptoTop['departamento']} (\${$promedio})</li>";
        }
        
        if (isset($estadisticas['empleados_sobre_promedio'])) {
            $cantidad = count($estadisticas['empleados_sobre_promedio']);
            $html .= "<li><strong>Empleados que ganan sobre el promedio:</strong> {$cantidad}</li>";
        }
        
        $html .= "
            </ul>
            
            <p>Para más detalles, consulte el reporte PDF adjunto.</p>
            
            <p>Saludos cordiales,<br>
            Sistema de Gestión Empresarial</p>
        </body>
        </html>";
        
        return $html;
    }

    /**
     * Genera contenido HTML para email de reporte de ventas
     * @param array $estadisticas
     * @return string
     */
    public function generarContenidoVentas(array $estadisticas): string
    {
        $html = "
        <html>
        <body style='font-family: Arial, sans-serif;'>
            <h2 style='color: #333;'>Reporte de Ventas</h2>
            <p>Estimado/a,</p>
            <p>Adjunto encontrará el reporte de ventas generado el " . date('d/m/Y H:i:s') . ".</p>
            
            <h3>Resumen Ejecutivo:</h3>
            <ul>
                <li><strong>Total de ventas:</strong> {$estadisticas['total_ventas']}</li>";
        
        if (isset($estadisticas['ingresos_totales'])) {
            $ingresos = number_format($estadisticas['ingresos_totales'], 0, ',', '.');
            $html .= "<li><strong>Ingresos totales:</strong> \${$ingresos}</li>";
        }
        
        if (isset($estadisticas['cliente_top'])) {
            $clienteTop = $estadisticas['cliente_top'];
            $gasto = number_format($clienteTop['total_gastado'], 0, ',', '.');
            $html .= "<li><strong>Cliente que más gastó:</strong> {$clienteTop['cliente']} (\${$gasto})</li>";
        }
        
        if (isset($estadisticas['producto_top'])) {
            $productoTop = $estadisticas['producto_top'];
            $html .= "<li><strong>Producto más vendido:</strong> {$productoTop['producto']} ({$productoTop['cantidad_total']} unidades)</li>";
        }
        
        $html .= "
            </ul>
            
            <p>Para más detalles, consulte el reporte PDF adjunto.</p>
            
            <p>Saludos cordiales,<br>
            Sistema de Gestión Empresarial</p>
        </body>
        </html>";
        
        return $html;
    }

    /**
     * Log de emails para desarrollo
     * @param string $destinatario
     * @param string $asunto
     * @param string $contenido
     * @param string|null $adjunto
     */
    private function logEmail(string $destinatario, string $asunto, string $contenido, ?string $adjunto): void
    {
        $log = [
            'fecha' => date('Y-m-d H:i:s'),
            'destinatario' => $destinatario,
            'asunto' => $asunto,
            'tiene_adjunto' => $adjunto ? 'Sí' : 'No',
            'nombre_adjunto' => $adjunto ?? 'N/A'
        ];
        
        error_log("EMAIL ENVIADO: " . json_encode($log));
    }
}
