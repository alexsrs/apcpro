<?php 
    $depoimentos = Painel::selectAll('tb_site.depoimentos');
?>


<div class="box-content">
<h2><i class="fa fa-id-card-o" aria-hidden="true"></i> Depoimentos cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td><i class="far fa-id-card" aria-hidden="true"></i> Nome</td>
                <td>Data</td>
                <td>Ações</td>
            </tr>

            <?php 
                foreach ($depoimentos as $key => $value) {
            ?>
            <tr>
                <td><?php echo $value['nome']; ?></td>
                <td><?php echo $value['data']; ?></td>
                <td><a class="btn edit" href=""><i class="fa fa-pencil"></i> Editar</a>
                <a class="btn delete" href=""><i class="fa fa-times"></i> Excluir</a></td>
            </tr>
            
            <?php } ?>
        </table>
    </div>

    <div class="paginacao">
        <a class="page-selected" href="">1</a>
        <a href="">2</a>
        <a href="">3</a>
    </div><!--paginacao-->
</div><!-- box-content -->