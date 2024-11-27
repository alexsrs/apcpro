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

<div class="box-content w33" style="text-align: center;">
    <h3 style="text-align: center; width: 100%;">Frequência Cardíaca</h3><br>
    <div style="max-height: 180px; display: flex; justify-content: center; align-items: center;">
        <canvas id="fcChart1"></canvas>
        <canvas id="fcChart2"></canvas>
        <canvas id="fcChart3"></canvas>
    </div>
</div><!-- box-content -->

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const ctx1 = document.getElementById('fcChart1');
  const ctx2 = document.getElementById('fcChart2');
  const ctx3 = document.getElementById('fcChart3');

  const data1 = {
    labels: ['Repouso'],
    datasets: [{
      label: 'bpm',
      data: [60, 177],
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
      data: [177],
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
      data: [117, 60],
      backgroundColor: [
        'rgba(207, 20, 189, 1.00)',
        'rgba(93,96,104,1)',
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
        const text = `${data.labels[0]}: ${data.datasets[0].data[0]} bpm`; // Exibe rótulo e valor
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

  new Chart(ctx1, config1);
  new Chart(ctx2, config2);
  new Chart(ctx3, config3);
</script>