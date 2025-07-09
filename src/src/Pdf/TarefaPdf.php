<?php
declare(strict_types=1);

namespace App\Pdf;

// Inclui a classe base do FPDF que você adicionou
require_once(ROOT . '/src/Lib/fpdf/fpdf.php');

// Define uma nova classe que estende a classe FPDF
class TarefaPdf extends \FPDF
{
    // Cabeçalho da página
    function Header()
    {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Relatorio de Tarefas', 1, 0, 'C');
        $this->Ln(15); // Pula linha
    }

    // Rodapé da página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo(), 0, 0, 'C');
    }

    // Tabela de tarefas
    function CreateTable($header, $data)
    {
        // Cores, largura da linha e fonte em negrito
        $this->SetFillColor(200, 220, 255);
        $this->SetTextColor(0);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        // Header da tabela
        $w = [15, 80, 30, 30, 30]; // Largura das colunas
        for ($i = 0; $i < count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        }
        $this->Ln();

        // Restauração de cor e fonte
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Dados
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row->id, 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row->descricao, 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, $row->data_prevista->format('d/m/Y'), 'LR', 0, 'C', $fill);
            $this->Cell($w[3], 6, $row->data_encerramento ? $row->data_encerramento->format('d/m/Y') : 'N/A', 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row->situacao, 'LR', 0, 'L', $fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Linha de fechamento
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
