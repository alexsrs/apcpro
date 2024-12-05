<?php
    if (isset($_GET['id'])) {
        $usuario_id = (int)$_GET['id']; // ID passado pela URL
    } else {
        $usuario_id = $_SESSION['id']; // ID do usuário logado
    }

    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$usuario_id]);
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    $dataNascimento = new DateTime($usuario['data_nascimento']);
    $idade = (new DateTime())->diff($dataNascimento)->y;
    $anamnese = new Anamnese();
    $dados_anamnese = $anamnese->buscarUltimaAnamnesePorUsuarioId($usuario_id);
    $perfil = new Perfil();
    $perfil = $perfil->buscarUltimoPerfilPorUsuarioId($usuario_id);
    // echo '<pre>'; print_r($perfil); echo '</pre>';
    $objetivo = $perfil['objetivo_id'];
    $altura = $perfil['altura'];
    $peso = $perfil['peso'];
    $imc = $peso / ($altura * $altura);
    $imc = number_format($imc, 2, '.', '');
    $obesidade = $perfil['obesidade'];
    $diabetes = $perfil['diabetes'];
    $hipertensao = $perfil['hipertensao'];
    $depressao = $perfil['depressao'];
    $pos_covid = $perfil['pos_covid'];
    $idoso = $perfil['idoso'];
    $gestante = $perfil['gestante'];
    $pos_parto = $perfil['posparto'];
    $emagrecer = $perfil['emagrecer'];
    $sql_objetivo = MySql::conectar()->prepare("SELECT objetivo FROM tb_objetivos_treinamento WHERE id = ?");
    $sql_objetivo->execute([$objetivo]);
    $objetivo = $sql_objetivo->fetch(PDO::FETCH_ASSOC);
    $professor_id = $usuario['professor_id'];
    $sql_professor = MySql::conectar()->prepare("SELECT nome FROM `tb_admin.usuarios` WHERE id = ?");
    $sql_professor->execute([$professor_id]);
    $professor = $sql_professor->fetch(PDO::FETCH_ASSOC);
    $professor = $professor['nome'];

    $aptidao = new AptidaoModel();
    $dados_aptidao = $aptidao->buscarUltimoAptidaoPorUsuarioId($usuario_id);
    $fc_repouso = $dados_aptidao['fc_repouso'];
    $fc_max = $dados_aptidao['fc_max_pred'];
    $fc_reserva = $fc_max - $fc_repouso;
    $vo2_max = $dados_aptidao['vo2_maximo'];
    $data_aptidao = new DateTime($dados_aptidao['data_avaliacao']);
    $metodo = $dados_aptidao['metodo'];
    //echo '<pre>'; print_r($dados_aptidao); echo '</pre>';
    //echo $data_aptidao->format('d/m/Y');

    // Consulta o sexo do usuário
    $sql = MySql::conectar()->prepare("SELECT sexo FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$usuario_id]);
    $sexo = $sql->fetch();

    // Calcula a idade do usuário
    $sql = MySql::conectar()->prepare("SELECT data_nascimento FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$usuario_id]);
    $dataNascimentoArray = $sql->fetch();
    $dataNascimento = new DateTime($dataNascimentoArray['data_nascimento']); // Converte a string em um objeto DateTime
    $idade = (new DateTime())->diff($dataNascimento)->y; // Calcula a diferença de idade em anos

    function classificarVo2Max($vo2_max, $sexo, $idade) {
      // Tabelas de classificação baseadas na idade e no sexo
      $classificacoes = [
          'm' => [
              [14, 19, 65, 61, 55, 50, 45, 35], // Excelente, Boa, Acima da média, Média, Abaixo da média, Ruim, Muito Ruim
              [20, 29, 61, 57, 52, 47, 42, 33],
              [30, 39, 59, 55, 50, 45, 40, 31],
              [40, 49, 54, 50, 45, 41, 36, 28],
              [50, 59, 51, 47, 43, 39, 34, 25],
              [60, 69, 46, 43, 39, 35, 31, 22],
              [70, 79, 43, 40, 36, 32, 28, 20],
              [80, 89, 41, 38, 34, 30, 26, 18],
              [90, 99, 39, 36, 32, 28, 24, 16]
          ],
          'f' => [
              [14, 19, 54, 50, 45, 40, 35, 25],
              [20, 29, 52, 48, 43, 38, 33, 23],
              [30, 39, 50, 46, 41, 36, 31, 21],
              [40, 49, 46, 42, 38, 33, 28, 19],
              [50, 59, 42, 39, 35, 30, 25, 17],
              [60, 69, 38, 35, 31, 27, 23, 15],
              [70, 79, 36, 33, 29, 25, 21, 13],
              [80, 89, 34, 31, 27, 23, 19, 11],
              [90, 99, 32, 29, 25, 21, 17, 9]
          ]
      ];
  
      // Encontra a faixa etária e retorna a classificação
      foreach ($classificacoes[$sexo] as $faixa) {
          [$minIdade, $maxIdade, $excelente, $boa, $acima, $media, $abaixo, $ruim] = $faixa;
          if ($idade >= $minIdade && $idade <= $maxIdade) {
              if ($vo2_max > $excelente) return 'Excelente';
              if ($vo2_max > $boa) return 'Boa';
              if ($vo2_max > $acima) return 'Acima da Média';
              if ($vo2_max > $media) return 'Média';
              if ($vo2_max > $abaixo) return 'Abaixo da Média';
              if ($vo2_max > $ruim) return 'Ruim';
              return 'Muito Ruim';
          }
      }
      return 'Faixa etária não encontrada';
  }
  
    // Calcular a classificação do VO₂ Máximo
    $sexo = strtolower($usuario['sexo']); // Converte o sexo para minúsculas
    $classificacao_vo2 = classificarVo2Max($vo2_max, $sexo, $idade);

    //consultar a ultima avaliação de composicao corporal
    $composicao = new ComposicaoCorporal();
    $dados_composicao = $composicao->buscarUltimoComposicaoPorUsuarioId($usuario_id);
    $percentual_gordura = $dados_composicao['percentual_gordura'];
    $massa_gordura = $dados_composicao['massa_gordura'];
    $massa_magra = $dados_composicao['massa_magra'];
    $data_avaliacao_composicao = new DateTime($dados_composicao['data_avaliacao']);
    //echo '<pre>'; print_r($dados_composicao); echo '</pre>';

    function classificarIMC($imc) {
      if ($imc < 18.5) {
        return 'Abaixo do peso';
      } elseif ($imc >= 18.5 && $imc < 24.9) {
        return 'Peso normal';
      } elseif ($imc >= 25 && $imc < 29.9) {
        return 'Sobrepeso';
      } elseif ($imc >= 30 && $imc < 34.9) {
        return 'Obesidade grau 1';
      } elseif ($imc >= 35 && $imc < 39.9) {
        return 'Obesidade grau 2';
      } else {
        return 'Obesidade grau 3';
      }
    }

    function classificarPercentualGordura($percentual_gordura, $sexo, $idade) {
      $classificacoes = [
        'm' => [
          [18, 39, 6, 14, 18, 25, 30], // Atleta, Excelente, Boa, Moderada, Alta
          [40, 59, 7, 16, 20, 26, 31],
          [60, 79, 9, 18, 22, 28, 33]
        ],
        'f' => [
          [18, 39, 14, 21, 25, 31, 36],
          [40, 59, 15, 23, 27, 32, 37],
          [60, 79, 16, 24, 29, 34, 39]
        ]
      ];

      foreach ($classificacoes[$sexo] as $faixa) {
        [$minIdade, $maxIdade, $atleta, $excelente, $boa, $moderada, $alta] = $faixa;
        if ($idade >= $minIdade && $idade <= $maxIdade) {
          if ($percentual_gordura <= $atleta) return 'Atleta';
          if ($percentual_gordura <= $excelente) return 'Excelente';
          if ($percentual_gordura <= $boa) return 'Boa';
          if ($percentual_gordura <= $moderada) return 'Moderada';
          return 'Alta';
        }
      }
      return 'Faixa etária não encontrada';
    }

    $classificacao_gordura = classificarPercentualGordura($percentual_gordura, $sexo, $idade);
    $classificacao_imc = classificarIMC($imc);

    // Função para calcular a relação cintura-quadril
    function calcularRelacaoCinturaQuadril($cintura, $quadril) {
      return $cintura / $quadril;
    }

    // Função para classificar a relação cintura-quadril
    function classificarRelacaoCinturaQuadril($relacao, $sexo) {
      if ($sexo == 'm') {
        if ($relacao < 0.90) return 'Baixo risco';
        if ($relacao <= 0.99) return 'Risco moderado';
        return 'Alto risco';
      } else {
        if ($relacao < 0.80) return 'Baixo risco';
        if ($relacao <= 0.85) return 'Risco moderado';
        return 'Alto risco';
      }
    }

    $sql_medidas = MySql::conectar()->prepare("SELECT cintura, quadril FROM `tb_medidas_corporais` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
    $sql_medidas->execute([$usuario_id]);
    $medidas = $sql_medidas->fetch(PDO::FETCH_ASSOC);

    $cintura = $medidas['cintura'];
    $quadril = $medidas['quadril'];

    $relacao_cintura_quadril = calcularRelacaoCinturaQuadril($cintura, $quadril);
    $classificacao_rcq = classificarRelacaoCinturaQuadril($relacao_cintura_quadril, $sexo);

    // Função para classificar o risco com base na circunferência abdominal
  function classificarRiscoCircunferenciaAbdominal($cintura, $sexo) {
    if ($sexo == 'm') {
      if ($cintura < 94) return 'Baixo risco';
      if ($cintura <= 102) return 'Risco aumentado';
      return 'Risco muito aumentado';
    } else {
      if ($cintura < 80) return 'Baixo risco';
      if ($cintura <= 88) return 'Risco aumentado';
      return 'Risco muito aumentado';
    }
  }

  $classificacao_risco_cintura = classificarRiscoCircunferenciaAbdominal($cintura, $sexo);

  function verificarDados($dados_anamnese, $perfil, $dados_aptidao, $dados_composicao, $sql_medidas, $usuario_id) {
    
    if (is_null($perfil)) {
        header("Location: formulario-perfis.php");
        exit();
    }

    if (is_null($dados_anamnese)) {
      header("Location: " . obterLinkAnamnese($usuario_id) . "?id=" . $usuario_id);
      exit();
    }

    if (is_null($sql_medidas)) {
      header("Location: medida-corporal.php");
      exit();
    }

    if (is_null($dados_composicao)) {
      header("Location: composicao-corporal.php");
      exit();
    }

    if (is_null($dados_aptidao)) {
        header("Location: aptidao-cardiorespiratoria.php");
        exit();
    }
    
}

// Exemplo de uso da função
verificarDados($dados_anamnese, $perfil, $dados_aptidao, $dados_composicao, $sql_medidas, $usuario_id);

?>

<div class="box-content left w100">

    <div class="box-dashboard w33 left">
        <div class="dashboard-wrapper">
            <p>Nome:</p>
            <h2><?php echo htmlspecialchars($usuario['nome']);?></h2>
        </div><!--w50 left-->
    </div><!--w33 left-->

    <div class="box-dashboard w33 left">
        <div class="dashboard-wrapper w20">
            <p>Idade:</p>
            <h2><?php echo htmlspecialchars($idade); ?></h2>
        </div><!--dashboard-wrapper w33 left-->
        <div class="dashboard-wrapper">
            <p>Nível:</p>
            <h2><?php echo isset($dados_anamnese['nivel_treinamento']) ? htmlspecialchars($dados_anamnese['nivel_treinamento']) : 'N/A'; ?></h2>
        </div><!--dashboard-wrapper w33 left-->
          
    </div><!--box-dashboard w33 left-->
    
    <div class="box-dashboard left">
        <p>Profissional:</p>
        <h2><?php echo htmlspecialchars($professor); ?></h2>
    </div><!--w33 left-->
           
    <div class="clear"></div><!-- clear -->
    <div class="box-dashboard left">
        <p>Objetivo:</p>
        <h2><?php echo isset($objetivo['objetivo']) ? htmlspecialchars($objetivo['objetivo']) : 'N/A'; ?></h2>
    </div><!--w33 left-->  
    
</div><!-- box-content -->


<div class="clear"></div><!-- clear -->

<div class="container-flex " style="height: 45%;">
  <div class="box-content w33 left" style="text-align: center; margin-right: 10px;">
    <h3 style="text-align: left; width: 100%;">Indice de massa corporal</h3><br><br>
    <div class="imc-info">
      <div class="imc-item w33">
        <h4>Peso: <?php echo htmlspecialchars($peso); ?> kg</h4>
        <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/peso.svg" alt="Ícone peso" style="width: 65%;">
      </div>
      <div class="imc-item w33">
        <h4>Altura: <?php echo htmlspecialchars($altura); ?> m</h4>
        <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/altura.svg" alt="Ícone altura" style="width: 65%;">
      </div>
      <div class="imc-item w33">
        <h4>IMC: <?php echo htmlspecialchars($imc); ?></h4>
        <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/equacao.svg" alt="Ícone equação" style="width: 65%;"><br><br><br><br>    
      </div>
      <p>IMC segundo a Organização Mundial da Saúde:</p><br><h4> <?php echo htmlspecialchars($classificacao_imc); ?></h4><br>
  </div>
  


      </div><!-- box-content -->

      <div class="box-content w33 right" style="text-align: center; margin-right: 10px;">
        <h3 style="text-align: left; width: 100%;">Composição corporal</h3><br>
        <div class="fcChart">
          <canvas id="fcChart5" width="400"></canvas>
        </div><br>
        <p style="text-align: justifys;">Percentual de Gordura Corporal (%GC) é utilizada para avaliar a distribuição de gordura corporal e o risco de doenças cardiovasculares e metabólicas.:</p><br><h4><?php echo htmlspecialchars($classificacao_gordura); ?></h4>
        
      </div><!-- box-content -->

  <div class="box-content w33 right" style="text-align: justify;">
    <h3 style="text-align: left; width: 100%;">Padrões fisiológicos de normalidade</h3><br>
    
    
   <p>Relação Cintura-Quadril é uma medida antropométrica utilizada para avaliar a distribuição de gordura corporal e o risco de doenças cardiovasculares e metabólicas. Ela é obtida dividindo a medida da circunferência da cintura pela circunferência do quadril.</p><h4 style="text-align: center;"><?php echo htmlspecialchars($classificacao_rcq); ?></h4>
  <br><br>

  <p>Circunferência Abdominal é um indicador importante pois reflete a quantidade de gordura visceral, que está associada a maior risco de doenças como diabetes tipo 2, hipertensão e dislipidemias:</p>
  <h4 style="text-align: center;"><?php echo htmlspecialchars($classificacao_risco_cintura); ?></h4>
  </div><!-- box-content -->

</div>


<div class="container-flex " style="height: 50%;">
  <div class="box-content w50 left" style="text-align: center; margin-right: 10px;">
    <h3 style="text-align: left; width: 100%;">Frequência Cardíaca</h3><br>
    <p>Data da Avaliação: <?php 
    
    echo $data_aptidao->format('d/m/Y');
?>
     - Método: <?php echo $metodo;?></p><br><br>
    <div class="fcChart">
      <canvas id="fcChart1" style="max-width: 100%;"></canvas>
      <canvas id="fcChart2" style="max-width: 100%;"></canvas>
      <canvas id="fcChart3" style="max-width: 100%;"></canvas>
    </div>

  <?php
  if ($fc_repouso < 60) {
    echo '<h4>Baixa</h4>';
  } elseif ($fc_repouso <= 100) {
    echo '<h4>Normal</h4>';
  } else {
    echo '<h4>Alta</h4>';
  }
  echo '<h4></h4>';
  ?>
  </div><!-- box-content -->

  <div class="box-content w50 right" style="text-align: center;">
    <h3 style="text-align: left; width: 100%;">Oxigênio - Vo² Máx</h3><br>
    <p>Data da Avaliação: <?php 
    
    echo $data_aptidao->format('d/m/Y');
?>

    
    
     - Método: <?php echo $metodo;?></p><br><br>
    <div class="fcChart">
      <canvas id="fcChart4" style="max-width: 100%;"></canvas>
    </div>
    <h4 style="padding-top 10px; text-align: center; width: 100%;"><?php echo htmlspecialchars($classificacao_vo2); ?></h4>
  </div><!-- box-content -->
</div>

<div class="clear"></div><!-- clear -->




<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx1 = document.getElementById('fcChart1');
  const ctx2 = document.getElementById('fcChart2');
  const ctx3 = document.getElementById('fcChart3');
  const ctx4 = document.getElementById('fcChart4');
  const ctx5 = document.getElementById('fcChart5');



  const data1 = {
    labels: ['Repouso'],
    datasets: [{
      label: 'bpm',
      data: [<?php echo $fc_repouso; ?>,<?php echo $fc_max; ?>],
      backgroundColor: [
        'rgba(207, 20, 189, 1.00)',
        'rgba(93,96,104,1)',
      ],
      borderWidth: 0
    }]
  };

  const data2 = {
    labels: ['Máxima'],
    datasets: [{
      label: 'bpm',
      data: [<?php echo $fc_max; ?>],
      backgroundColor: [
        'rgba(207, 20, 189, 1.00)',
        'rgba(93,96,104,1)',
      ],
      borderWidth: 0
    }]
  };

  const data3 = {
    labels: ['Reserva'],
    datasets: [{
      label: 'bpm',
      data: [<?php echo $fc_reserva; ?>, <?php echo $fc_repouso; ?>],
      backgroundColor: [
        'rgba(207, 20, 189, 1.00)',
        'rgba(93,96,104,1)',
      ],
      borderWidth: 0
    }]
  };


  const data4 = {


    labels: ['Vo² Máximo'],
    datasets: [{
      label: 'mL/kg/min',
      data:[<?php echo $vo2_max; ?>],
      backgroundColor: [
        'rgba(58,115,170,1)',
        'rgba(93,96,104,1)',
      ],
      borderWidth: 0
    }]
  };

  const data5 = {
    labels: ['Massa gorda - <?php echo $massa_gordura; ?> kg', 'Massa magra - <?php echo $massa_magra; ?> kg'],
    datasets: [{
      label: 'Kg',
      data: [<?php echo $massa_gordura; ?>, <?php echo $massa_magra; ?>],
      backgroundColor: [
        'rgba(58,115,170,1)',
        'rgba(207, 20, 189, 1.00)',
      ],
      borderWidth: 0
    }]
  };


  // Plugin customizado para exibir o rótulo e o valor
  const customLegend = {
    id: 'customLegend',
    beforeDraw(chart) {
      const { ctx, chartArea, data } = chart;
      const { left, width } = chartArea;

      ctx.save();
      ctx.textAlign = 'center';
      ctx.textBaseline = 'middle';
      ctx.font = 'bold 14px Arial';

      // Exibir o rótulo e o valor
      if (data.labels.length > 0 && data.datasets[0].data.length > 0) {
        let text;
        if (chart.canvas.id === 'fcChart4') {
          text = `${data.labels[0]}: ${data.datasets[0].data[0]} mL/kg/min`; // Exibe rótulo e valor para o quarto gráfico
        } else {
          text = `${data.labels[0]}: ${data.datasets[0].data[0]} bpm`; // Exibe rótulo e valor para os outros gráficos
        }
        const yOffset = chart.height - 30; // Ajusta a posição abaixo do gráfico
        ctx.fillText(text, left + width / 2, yOffset);
      }
      ctx.restore();
    }
  };

  const config1 = {
    type: 'doughnut',
    data: data1,
    options: {
      responsive: true,
      layout: {
        padding: {
          bottom: 50 // Reserva espaço para a legenda
        }
      },
      plugins: {
        legend: {
          display: false, // Remove a legenda padrão
        },
      }
    },
    plugins: [customLegend],
  };

  const config2 = {
    type: 'doughnut',
    data: data2,
    options: {
      responsive: true,
      layout: {
        padding: {
          bottom: 50 // Reserva espaço para a legenda
        }
      },
      plugins: {
        legend: {
          display: false, // Remove a legenda padrão
        },
      }
    },
    plugins: [customLegend],
  };

  const config3 = {
    type: 'doughnut',
    data: data3,
    options: {
      responsive: true,
      layout: {
        padding: {
          bottom: 50 // Reserva espaço para a legenda
        }
      },
      plugins: {
        legend: {
          display: false, // Remove a legenda padrão
        },
      }
    },
    plugins: [customLegend],
  };

  const config4 = {
    type: 'bar',
    data: data4,
    options: {
        indexAxis: 'y', // Troca os eixos
        responsive: true,
        layout: {
            padding: {
                bottom: 50 // Reserva espaço para a legenda
            }
        },
        plugins: {
            legend: {
                display: false, // Remove a legenda padrão
            },
        },
        scales: {
            y: {
                min: 0, // Valor mínimo no eixo Y
                max: 100, // Valor máximo no eixo Y
                ticks: {
                    stepSize: 10, // Incremento entre os valores do eixo Y
                    autoSkip: false, // Garante que nenhum tick será omitido
                    maxTicksLimit: 11, // Limita os ticks ao número esperado (0 a 100, com 10 em 10)
                    callback: function(value) {
                        return value === 0 ? '' : value; // Oculta o valor 0
                    }
                }
            },
            x: {
                min: 0, // Valor mínimo no eixo X
                max: 100, // Valor máximo no eixo X
                ticks: {
                    stepSize: 10, // Incremento entre os valores do eixo X
                }
            }
        }
    },
    plugins: [customLegend],
};
const config5 = {
  type: 'pie',
  data: data5,
  options: {
    responsive: true,
    
    plugins: {
      legend: {
        display: true,
        position: 'bottom', // Posiciona a legenda na parte inferior
        labels: {
          boxWidth: 20, // Largura da caixa de cor da legenda
          font: {
            size: 14 // Tamanho da fonte da legenda
          }
        }
      }
    }
  }
};
  
  new Chart(ctx1, config1);
  new Chart(ctx2, config2);
  new Chart(ctx3, config3);
  new Chart(ctx4, config4);
  new Chart(ctx5, config5);
 
</script>