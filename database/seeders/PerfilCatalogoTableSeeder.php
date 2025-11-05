<?php

namespace Database\Seeders;

use App\Models\PerfilCatalogo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerfilCatalogoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PerfilCatalogo::create([
            'id' => '99307e4c-76b4-42f8-8ae3-e9f919c38c29',
            'perfil' => 'Super Usuário',
            'descrição' => 'Perfil utilizado para critério de desenvolvimento e suporte, não atribuir para usuários convencionais ',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Diretoria',
            'descrição' => 'Perfil utilizado por Diretores da empresa, é um conjunto de acessos prédefinidos para fazer a gestão do negocio e ter acesso a graficos com demonstrativos de rendimentos, ter acesso e fazer o manuseio da área administrativa e financeira como um todo ',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Administrador',
            'descrição' => 'Perfil utilizado para Administradores da empresa, é um conjunto de acessos prédefinidos para fazer a gestão do negocio e ter acesso a graficos com demonstrativos de rendimentos  ',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Comercial',
            'descrição' => 'Perfil utilizado para administração dos clientes e gestão comercial e SAC ',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Financeiro',
            'descrição' => 'Perfil para administração do financeiro, inserção de contas a pagar e a receber, gerenciamento de contas e reserva de cotas para gastos  ',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Recursos Humanos',
            'descrição' => 'Perfil para administração dos funcionarios, avaliação e manutenção dos cadastros, registros de autuações e administração de recursos referente aos funcionarios ',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Operacional',
            'descrição' => 'Perfil para inserção de EDIs e emição de CTEs, administração dos veiculos e equipes de rua  ',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Clientes',
            'descrição' => 'Menu Clientes',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Veículos',
            'descrição' => 'Menu Veículos',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Motoristas',
            'descrição' => 'Menu Motoristas',
        ]);
        
        PerfilCatalogo::create([
            'perfil' => 'Contábil',
            'descrição' => 'Menu Contábil',
        ]);

        PerfilCatalogo::create([
            'perfil' => 'Relatorios',
            'descrição' => 'Menu Relatorios',
        ]);
        
    }
}
