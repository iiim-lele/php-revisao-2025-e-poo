<?php
// ==================================
// SISTEMA DE LOCADORA DE VEÍCULOS
// ==================================

// Classe abstrata Base
abstract class Veiculo {
    protected string $modelo;
    protected string $placa;
    protected bool $disponivel;

    // Inicialização com método Construtor
    public function __construct(string $modelo, string $placa) {
        $this->modelo = $modelo;
        $this->placa = $placa;
        $this->disponivel = true;
    }

    // Método abstrato (Não implementado agora)
    abstract public function calcularAluguel(int $dias): float;

    // Métodos concretos (Já implementados)
    public function isDisponivel(): bool {
        return $this->disponivel;
    }

    public function getModelo(): string {
        return $this->modelo;
    }

    public function alugar(): bool {
        if ($this->disponivel) {
            $this->disponivel = false;
            return true;
        }
        return false;
    }

    public function devolver() {
        $this->disponivel = true;
    }
}

// Classes Concretas (Carro e Moto)
// Pilar da Herança aplicado abaixo
class Carro extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 100.00;
    }
}

class Moto extends Veiculo {
    public function calcularAluguel(int $dias): float {
        return $dias * 50.00;
    }
}

// Classe gerenciadora (Locadora)
class Locadora {
    // Array
    private array $veiculos = [];

    // Métodos para gerenciar (adicionar, alugar e devolver)
    public function adicionarVeiculo(Veiculo $veiculo) {
        $this->veiculos[$veiculo->getModelo()] = $veiculo;
        echo "Veículo '{$veiculo->getModelo()}' adicionado ao acervo.<br>";
    }

    public function alugarVeiculo(string $modelo) {
        if (isset($this->veiculos[$modelo])) {
            $veiculo = $this->veiculos[$modelo];
            if ($veiculo->alugar()) {
                $tipo = get_class($veiculo);
                echo "$tipo '{$modelo}' alugado com sucesso!<br>";
            } else {
                echo "O veículo '{$modelo}' já está alugado.<br>";
            }
        } else {
            echo "Veículo '{$modelo}' não encontrado.<br>";
        }
    }

    public function devolverVeiculo(string $modelo) {
        if (isset($this->veiculos[$modelo])) {
            $this->veiculos[$modelo]->devolver();
            $tipo = get_class($this->veiculos[$modelo]);
            echo "$tipo '{$modelo}' devolvido com sucesso!<br>";
        } else {
            echo "Veículo '{$modelo}' não encontrado.<br>";
        }
    }

    public function calcularValorAluguel(string $modelo, int $dias) {
        if (isset($this->veiculos[$modelo])) {
            $valor = $this->veiculos[$modelo]->calcularAluguel($dias);
            $tipo = get_class($this->veiculos[$modelo]);
            echo "Valor do aluguel do " . strtolower($tipo) . " por $dias dias: R$" . number_format($valor, 2) . "<br>";
        }
    }
}

// Criando um Objeto/Instância
$locadora = new Locadora();

// Criando itens (Carro e Moto 1)
$carro1 = new Carro("HB20", "ABC1234");
$moto1 = new Moto("Yamaha XTZ", "XYZ9876");

// Adicionar itens a locadora e exibir
$locadora->adicionarVeiculo($carro1);
$locadora->adicionarVeiculo($moto1);

echo "<br>";

$locadora->alugarVeiculo("HB20");
$locadora->alugarVeiculo("Yamaha XTZ");

echo "<br>";

$locadora->devolverVeiculo("HB20");

echo "<br>";

$locadora->calcularValorAluguel("HB20", 3);
$locadora->calcularValorAluguel("Yamaha XTZ", 3);
?>
