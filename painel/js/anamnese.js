let contadorRegiao = 1;

        // Função para adicionar uma nova região
        function adicionarRegiao() {
            contadorRegiao++;
            const container = document.getElementById('regioes-container');

            const div = document.createElement('div');
            div.className = 'regiao-container';

            div.innerHTML = `
                <label for="regiao${contadorRegiao}">Região:</label>
                <input type="text" id="regiao${contadorRegiao}" name="regiao[]" required><br>
                <label for="nota${contadorRegiao}">Nota:</label>
                <input type="number" id="nota${contadorRegiao}" name="nota[]" min="0" max="10" placeholder="0-10" required><br>
                <label for="dificuldade${contadorRegiao}">Dificuldade:</label>
                <input type="text" id="dificuldade${contadorRegiao}" name="dificuldade[]">
                <button type="button" class="remove-regiao">Remover</button><br>
            `;

            container.appendChild(div);

            // Adicionar event listener ao botão "Remover" recém-criado
            const btnRemover = div.querySelector('.remove-regiao');
            btnRemover.addEventListener('click', function() {
                removerRegiao(this);
            });
        }

        // Função para remover uma região
        function removerRegiao(botao) {
            const div = botao.parentElement;
            div.remove();
        }

        // Adicionar event listener ao botão "Adicionar Região" após o carregamento do DOM
        document.addEventListener('DOMContentLoaded', function() {
            const btnAdicionar = document.getElementById('adicionar-regiao');
            btnAdicionar.addEventListener('click', adicionarRegiao);

            // Adicionar event listener ao botão "Remover" da primeira região
            const btnRemoverInicial = document.querySelector('.regiao-container .remove-regiao');
            btnRemoverInicial.addEventListener('click', function() {
                removerRegiao(this);
            });
        });