<?php
    $mensagem = '';
    if(isset($_GET['status'])){
        switch ($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação realizada com sucesso</div>';
                break;
            case 'error':
                $mensagem = '<div class="alert alert-danger">Ação não executada</div>';
                break;
            
            default:
                break;
        }
    }

    $resultados = '';
    foreach($vagas as $vaga){
        $resultados .= '<tr>
                            <td>'.$vaga->id.'</td>
                            <td>'.$vaga->titulo.'</td>
                            <td>'.$vaga->descricao.'</td>
                            <td>'.($vaga->ativo == 's'? 'ATIVO' : 'INATIVO').'</td>
                            <td>'.date('d/m/Y à\s H:i:s',strtotime($vaga->data)).'</td>
                            <td>
                                <a href="editar.php?id='.$vaga->id.'">
                                    <button class="btn btn-primary">Editar</button>
                                </a>
                                <a href="excluir.php?id='.$vaga->id.'">
                                    <button class="btn btn-danger">Excluir</button>
                                </a>
                            </td>
                        </tr>';
    }
?>

<main>
    <?= $mensagem ?>
    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">Nova vaga</button>
        </a>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $resultados ?>
            </tbody>
        </table>
    </section>
</main>