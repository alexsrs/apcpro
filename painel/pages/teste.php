<body> 
    <div>
        Cadastro de Atleta
        <div class="page-title-subheading hide-print">
        Gerencie seus atletas
        </div>
    </div>
                          

<form action="/Atleta" defaultbutton="btnSearch" id="formGrid" method="post">    <div class="row">
        <div class="col-12">
            <div class="row">
                
                    <a class="mb-2 mr-2 btn btn-block btn-primary" href="/Atleta/Novo">
                        <i class="fa fa-plus mr-2"></i> Novo atleta
                    </a>
               
            </div>

            <div class="main-card mb-3 card">
                <div class="card-header">
                    Filtros
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="txtNomeFiltro">Grupo</label>
                                <select name="cmbGrupoFiltro" id="cmbGrupoFiltro" class="form-control"><option value="">Selecione um grupo</option>
<option value="null">Atletas sem grupo</option>
<option value="1278">VOLEIBOL FEMININO - SUPERLIGA 2024</option>
</select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                            <div class="form-group">
                                <label for="txtNomeFiltro">Nome</label>
                                <input type="text" name="txtNomeFiltro" id="txtNomeFiltro" placeholder="Nome do atleta" class="form-control default-focus">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="txtQtdIdadeFiltro">Idade</label>
                                <input type="number" name="txtQtdIdadeFiltro" id="txtQtdIdadeFiltro" placeholder="Idade do atleta" class="form-control">
                            </div>
                        </div>
                        <div class="col-12 col-sm-3 col-md-3 col-lg-3">
                            <div class="form-group">
                                <label for="cmbGeneroFiltro">Gênero</label>
                                <select id="cmbGeneroFiltro" name="cmbGeneroFiltro" class="form-control">
                                    <option selected="" value="">Selecione um gênero</option>
                                    <option value="m">Masculino</option>
                                    <option value="f">Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-2">
                        <a id="btnSearch" onclick="showGrid();" href="javascript:void(0);" class="btn btn-block btn-info">
                            <i class="fa fa-search mr-2"></i>
                            Pesquisar
                        </a>
                    </div>
                </div>
            </div>



            
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Listagem</h5>
                    <div class="table-responsive-sm table-responsive-md">
                        <div id="itemsTable_wrapper" class="dataTables_wrapper no-footer"><div class="dataTables_length" id="itemsTable_length"><label>Exibir <select name="itemsTable_length" aria-controls="itemsTable" class=""><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> registros por página</label></div><table id="itemsTable" class="mb-10 table table-hover table-striped dataTable no-footer" role="grid" aria-describedby="itemsTable_info" style="width: 1342px;">
                            <thead class="thin-border-bottom">
                                <tr role="row"><th class="text-center sorting_disabled" style="width: 86px;" rowspan="1" colspan="1" aria-label=""></th><th class="text-left sorting_asc" tabindex="0" aria-controls="itemsTable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                        Nome completo
                                    : activate to sort column descending" style="width: 360px;">
                                        Nome completo
                                    </th><th class="text-center sorting" tabindex="0" aria-controls="itemsTable" rowspan="1" colspan="1" aria-label="
                                        Idade
                                    : activate to sort column ascending" style="width: 65px;">
                                        Idade
                                    </th><th class="text-center sorting" tabindex="0" aria-controls="itemsTable" rowspan="1" colspan="1" aria-label="
                                        Data de Nascimento
                                    : activate to sort column ascending" style="width: 199px;">
                                        Data de Nascimento
                                    </th><th class="text-center sorting" tabindex="0" aria-controls="itemsTable" rowspan="1" colspan="1" aria-label="
                                        Gênero
                                    : activate to sort column ascending" style="width: 80px;">
                                        Gênero
                                    </th><th class="text-center sorting" tabindex="0" aria-controls="itemsTable" rowspan="1" colspan="1" aria-label="
                                        Grupo
                                    : activate to sort column ascending" style="width: 336px;">
                                        Grupo
                                    </th></tr>
                            </thead>
                        <tbody><tr role="row" class="odd"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="top-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, -4px, 0px);">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8780" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8780" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8780" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8780);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">ANITA TEIXEIRA DOS REIS</td><td class=" text-center">16</td><td class=" text-center">21/04/2008</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="even"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8781" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8781" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8781" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8781);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">BEATRIZ FLAVIO DE CARVALHO</td><td class=" text-center">25</td><td class=" text-center">18/12/1998</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="odd"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8803" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8803" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8803" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8803);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">BRUNA PERES TAVARES</td><td class=" text-center">20</td><td class=" text-center">26/07/2004</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="even"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8768" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8768" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8768" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8768);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">CAMILLY CRISTINA DE ORNELLAS</td><td class=" text-center">21</td><td class=" text-center">04/09/2003</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="odd"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8804" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8804" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8804" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8804);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">FABIANO DE BRITO</td><td class=" text-center">49</td><td class=" text-center">24/12/1974</td><td class=" text-center">Masculino</td><td class=" text-center">Atleta sem grupo</td></tr><tr role="row" class="even"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8787" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8787" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8787" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8787);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">FLÁVIA MARIANA LISBOA GUIOMAR</td><td class=" text-center">19</td><td class=" text-center">29/09/2005</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="odd"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8765" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8765" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8765" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8765);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">GABRIELI GAGLIASSI</td><td class=" text-center">23</td><td class=" text-center">14/03/2001</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="even"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8779" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8779" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8779" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8779);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">GABRIELLE DE SOUZA TERTO CAVALCANTE</td><td class=" text-center">18</td><td class=" text-center">15/09/2006</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="odd"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8769" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8769" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8769" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8769);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">GEOVANNA GONÇALVES ROCHA</td><td class=" text-center">16</td><td class=" text-center">05/11/2007</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr><tr role="row" class="even"><td class=" text-center"><div class="dropdown d-inline-block">   <button name="btnGridAcao" type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="dropdown-toggle btn btn-info">      <span class="btn-icon-wrapper pr-2 opacity-7"><i class="fa fa-business-time fa-w-20"></i></span>      Ações   </button>   <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 33px, 0px); top: 0px; left: 0px; will-change: transform;">       <h6 tabindex="-1" class="dropdown-header text-black">Escolha uma ação</h6>       <div tabindex="-1" class="dropdown-divider"></div><a href="MonitoramentoIndividual/Atleta/8767" tabindex="0" class="dropdown-item text-info">                  <i class="fa fa-chart-line mr-2"></i>                  Monitorar               </a>             <a href="TreinoIndividual/Novo/8767" tabindex="0" class="dropdown-item text-success">                  <i class="fa fa-dumbbell mr-2"></i>                  Cadastrar Treino               </a><a name="btnGridEdicao" href="Atleta/Edit/8767" tabindex="0" class="dropdown-item text-primary">   <i class="fa fa-pencil-alt mr-2"></i>   Editar</a><a name="btnGridExclusao" onclick="openDeleteModal('Atleta', 8767);" href="javascript:void(0);" tabindex="0" class="dropdown-item text-danger">   <i class="fa fa-trash-alt mr-2" style="width: 14px;"></i>   Excluir</a>   </div></div></td><td class="text-left sorting_1">ISABELA CRISTINA DA SILVA ABREU</td><td class=" text-center">23</td><td class=" text-center">02/02/2001</td><td class=" text-center">Feminino</td><td class=" text-center">VOLEIBOL FEMININO - SUPERLIGA 2024</td></tr></tbody></table><div class="dataTables_info" id="itemsTable_info" role="status" aria-live="polite">Exibindo 1 até 10 de 15 registros</div><div class="dataTables_paginate paging_full_numbers" id="itemsTable_paginate"><a class="paginate_button first disabled" aria-controls="itemsTable" data-dt-idx="0" tabindex="-1" id="itemsTable_first">Início</a><a class="paginate_button previous disabled" aria-controls="itemsTable" data-dt-idx="1" tabindex="-1" id="itemsTable_previous">Anterior</a><span><a class="paginate_button current" aria-controls="itemsTable" data-dt-idx="2" tabindex="0">1</a><a class="paginate_button " aria-controls="itemsTable" data-dt-idx="3" tabindex="0">2</a></span><a class="paginate_button next" aria-controls="itemsTable" data-dt-idx="4" tabindex="0" id="itemsTable_next">Próximo</a><a class="paginate_button last" aria-controls="itemsTable" data-dt-idx="5" tabindex="0" id="itemsTable_last">Final</a></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input name="__RequestVerificationToken" type="hidden" value="CfDJ8InBvmTSA-ZOj0HGg8xpvZ81Gdns7gJbBwVXKH_4nHJadbnBEj53azOfK2OfGWTNHHQOJhhHHcupEa1Xe2L1RZTtXbeWgDnouJdkz-_XdsXtX5rtK_uJK2efWM5iDB0JLupJ9VcPQthVXsLUUzBsVHLmif20eDIcpKXmO1KJBQPebprp4iKCUPqZz7qwtsJUZA"></form>
                    <div id="toast-container" class="toast-bottom-right fade hidden">
                        <div class="toast" aria-live="assertive" style="">
                            <div class="toast-title"></div>
                            <div class="toast-message"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                </div>
                <div class="modal-body fsize-2">
                    <label id="lblConfirmModalQuestion"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCancel" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Cancelar</button>
                    <button type="button" id="btnConfirm" name="btnConfirmDelete" class="btn btn-success">
                        <i class="fa fa-check mr-2"></i>
                        Confirmar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body fsize-2">
                    Deseja realmente excluir o registro selecionado?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Cancelar</button>
                    <button type="button" id="btnConfirmDelete" name="btnConfirmDelete" class="btn btn-success">
                        <i class="fa fa-check mr-2"></i>
                        Confirmar exclusão
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalLoading" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Por favor, aguarde uns instantes</h5>
                </div>
                <div class="modal-body text-center">
                    <div class="spinner-border text-primary" style="width: 10rem; height: 10rem;" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <br>
                    <br>
                    Isto pode levar alguns segundos. Por favor, aguarde...
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-danger" id="exampleModalLabel">Ocorreu um problema</h5>
                </div>
                <div class="modal-body">
                    <label id="lblErrorMessage" class="text-danger fsize-2"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times mr-2"></i>Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalSuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLabel">Finalizado com sucesso!</h5>
                </div>
                <div class="modal-body">
                    <label id="lblSuccessMessage" class="text-success fsize-2"></label>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCloseSuccessModal" class="btn btn-success" data-dismiss="modal"><i class="fa fa-check mr-2"></i>Fechar</button>
                </div>
            </div>
        </div>
    </div>
    


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

    <script type="text/javascript" src="/lib/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/lib/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha512-9D39OISItQmmaHlgjDXXwRVfk9zsM8qHUIL1nzVVJ0DWXpo0SgRNfsU08CeKa7bw7YEEf3Pc9hX33NduCkggCQ==" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="/admin/scripts/main.js"></script>
    <script type="text/javascript" src="/lib/DataTables/datatables.js"></script>
    <script type="text/javascript" src="/admin/scripts/DataTableDefaultControllers.js"></script>
    <script type="text/javascript" src="/admin/scripts/layout.js?v=1-2"></script>
    <script type="text/javascript" src="/lib/jquery/dist/jquery.maskedinput.min.js"></script>
    <script type="text/javascript" src="/lib/jquery/dist/jquery-dateformat.min.js"></script>
    <script type="text/javascript" src="/lib/jquery/dist/jquery.maskMoney.min.js"></script>
    <script type="text/javascript" src="/lib/jquery/dist/jQueryFixes.js"></script>
    <script type="text/javascript" src="/lib/jquery/jquery-ui.min.js"></script>

        <script type="text/javascript" src="/admin/scripts/datepicker-pt-BR.js"></script>

    <script type="text/javascript" src="/admin/scripts/CustomRange.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="/charts/DefaultChartJsSettings.js"></script>
    <script type="text/javascript" src="/admin/scripts/replace-dot.js"></script>
    <script type="text/javascript" src="/admin/scripts/datepicker-config.js"></script>
    <script type="text/javascript" src="/admin/scripts/botao-toggle.js"></script>
    <script type="text/javascript" src="/views/shared/date-utils.js?v1-1"></script>

        <script type="text/javascript">        
            if ("serviceWorker" in navigator) {
                navigator.serviceWorker.register("/worker-padrao.js");
            }

            ConfereSituacaoTreinador();
        </script>
    
    <script type="text/javascript">
        $(document).ready(function () {
            showGrid();
        });

        function showGrid() {
            var controllerName = "Atleta";
            var columns = [
                {
                    data: "codigoAtleta", className: "text-center",
                    render: function (data, type, row) {
                        var addActions = '<a href="MonitoramentoIndividual/Atleta/' + data + '" tabindex="0" class="dropdown-item text-info">' +
                            '                  <i class="fa fa-chart-line mr-2"></i>' +
                            '                  Monitorar' +
                            '               </a>' +
                            '             <a href="TreinoIndividual/Novo/' + data + '" tabindex="0" class="dropdown-item text-success">' +
                            '                  <i class="fa fa-dumbbell mr-2"></i>' +
                            '                  Cadastrar Treino' +
                            '               </a>';

                        return returnDefaultActionButton(controllerName, data, addActions);
                    }
                },
                { data: "nome", className: "text-left" },
                { data: "idade", className: "text-center" },
                {
                    data: "dataNascimento", className: "text-center",
                    render: function (data) {
                        return $.format.date(data, "dd/MM/yyyy");
                    }
                },
                { data: "descricaoGenero", className: "text-center" },
                { data: "grupo.nome", className: "text-center", defaultContent: "Atleta sem grupo" }
            ];

            var tbc = createDefaultTable(controllerName, columns);
        };
    </script>


    <script type="text/javascript" src="/views/shared/modal.js"></script>
    <script type="text/javascript" src="/views/shared/ultimo_acesso.js"></script>
    <script type="text/javascript" src="/lib/jquery-validation/dist/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/lib/jquery-validation-unobtrusive/jquery.validate.unobtrusive.min.js"></script>
    <script type="text/javascript" src="/lib/jquery/dist/jQueryFixes.js"></script>
    <script defer="" src="/views/dashboard/tutorial.js?v1-4"></script>


<container id="my-app-container"><div style="position: absolute; top: 0px; z-index: 2147483647;"><div id="squareDiv" style="display: none;"></div><div></div></div></container><div class="jvectormap-tip"></div></body>