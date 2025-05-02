function updateTable() {
    $.ajax({
        url: 'treinos.php', // Substitua pelo nome real do seu arquivo PHP
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Limpe a tabela
            $('table tbody').empty();

            // Preencha a tabela com os novos dados
            $.each(data, function(index, row) {
                var newRow = '<tr>' +
                    '<td>' + row.nome + '</td>' +
                    '<td>' + row.exercicio + '</td>' +
                    '<td>' + row.series + '</td>' +
                    '<td>' + row.repeticoes + '</td>' +
                    '<td>' + row.carga + '</td>' +
                    '<td>' + row.observacoes + '</td>' +
                    '<td><a href="treinos.php?id=' + row.id_treino + '">Editar</a> | <a href="treinos.php?delete_id=' + row.id_treino + '">Excluir</a></td>' +
                    '</tr>';

                $('table tbody').append(newRow);
            });
        }
    });
}

// Chame a função updateTable no carregamento da página
$(document).ready(function() {
    updateTable();
});