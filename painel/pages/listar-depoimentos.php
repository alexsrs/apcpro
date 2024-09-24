<?php 
    $depoimentos = Painel::selectAll('tb_site.depoimentos');
?>


<div class="box-content">
<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Depoimentos cadastrados</h2>
    <table>
        <tr>
            <td><i class="far fa-id-card" aria-hidden="true"></i> Nome</td>
            <td>Data</td>
            <td>#</td>
            <td>#</td>
        </tr>

        <?php 
            foreach ($depoimentos as $key => $value) {
        ?>
        <tr>
            <td><?php echo $value['nome']; ?></td>
            <td><?php echo $value['data']; ?></td>
            <td><a class="btn edit" href=""><i class="fa fa-pencil"></i> Editar</a></td>
            <td><a class="btn delete" href=""><i class="fa fa-times"></i> Excluir</a></td>
        </tr>
        
        <?php } ?>
    </table>


</div><!-- box-content -->