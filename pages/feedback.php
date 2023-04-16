<head>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>public/css/page_feedback.css">
</head>

<main>
    <section class="feedback">
        <div class="enviar-feedback">

            <h3>Envie seu feedback!</h3>

            <p>Fale-nos o que você está achando sobre o site até agora de modo anônimo. Podem ser comentários gerais ou sobre algo específico. Sua opinião é importante para nós.</p>

            <form action="<?php echo INCLUDE_PATH; ?>enviar_feedback" method="POST" class="formulario">
                <div class="linha field">

                    <label for="assuntoId">Assunto: </label>
                    <!-- <input type="text" name="assunto" id="assuntoId" placeholder="Ex: Mau-funcionamento de alguma parte do site..." required> -->
                    <?php
                        if (isset($_GET['questao_relatada'])) {
                            $questao_relatada = "Problema com a questão #" . $_GET['questao_relatada'] . "...";

                            $questao_relatada_style = "border: 2px dashed var(--color-red0);";
                        } else {
                            $questao_relatada = "";
                            $questao_relatada_style = "";
                        }
                        
                        echo "<input type='text' name='assunto' id='assuntoId' placeholder='Ex: Mau-funcionamento de alguma parte do site...' value='$questao_relatada'  style='$questao_relatada_style;' required>";
                    ?>
                </div>
                
                <div class="linha field mensagem">
                    <label for="msgId">Mensagem: </label>
                    <textarea name="msg" id="msgId" cols="30" rows="10" placeholder="Detalhes/sugestões..." required></textarea>
                </div>
                
                <div class="linha enviar">
                    <input class="botaofilled-verde" type="submit" value="Enviar">
                </div>
            </form>
        </div>
        
    </section>
</main>
