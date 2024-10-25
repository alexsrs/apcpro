<?php 

verificaPermissaoPagina(1);

// Instancia a classe Anamnese
$exercicio = new Exercicio();
// Busca as anamneses relacionadas ao usuário
$exercicios = $exercicio->buscarExercicios();






?>


<div class="box-content">
<table id="lista-exercicios" class="display" style="width:100%" data-order='[[ 1, "asc" ]]'>
        <thead>
            <tr>
                <td>Nome</td>
                <td>Nível de dificuldade</td>
                <td>METs</td>
                <td>Ações</td>
                
            </tr>
        </thead>
        <tbody>
        <?php if(count($exercicios) > 0): ?>
                <?php foreach($exercicios as $exercicio): ?>
                    <tr>
                        <td><?php echo $exercicio['nome_exercicio']; ?></td>
                        <td><?php echo $exercicio['nivel_dificuldade']; ?></td>
                        <td><?php echo $exercicio['mets_consumo_energetico']; ?></td>
                        <td><a class="btn view" href="<?php echo INCLUDE_PATH_PAINEL . 'ver-exercicio?id=' . $exercicio['id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Ver</a></td>

                    </tr>
                <?php endforeach; ?>
            
            <?php endif; ?>
            
        </tbody>
    </table>

</div>