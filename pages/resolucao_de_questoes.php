<main>
	<section class="resolvendo-questoes">
		<div class="questao">

			<?php
				if(!empty($_POST["id_questao"]))
					$_SESSION["id_questao"] = $_POST["id_questao"];

				$id_questao = $_SESSION["id_questao"];

				$result = Questao::selectQuestion($id_questao);
				$questao = $result[0];

				if(isset($_SESSION['id_usuario'])){
					$id_usuario = $_SESSION['id_usuario'];

					if(User::checksQuestionResolved($id_usuario, $id_questao) == 1)
						$resolveu = "<i class='fa-regular fa-check'></i> Questão já resolvida";
					else
						$resolveu = "<i class='fa-regular fa-clock'></i> Questão ainda não resolvida";
				}

				$tipo = $questao['tipo'];

				$vestibular = $questao['vestibular'];
				$ano = $questao['ano'];
				$sub_tema = $questao['subtema'];
				$id_materia = $questao['id_materia'];

				$enunciado = $questao['enunciado'];
				$imagem = $questao['imagem'];
				$especial = $questao['especial'];
				$pergunta = $questao['pergunta'];
				
				$alternativa_A = $questao['alternativa_a'];
				$alternativa_B = $questao['alternativa_b'];
				$alternativa_C = $questao['alternativa_c'];
				$alternativa_D = $questao['alternativa_d'];
				$alternativa_E = $questao['alternativa_e'];

				$gabarito = $questao['alternativa_certa'];
				$explicacao = $questao['explicacao'];

				$resolucao = INCLUDE_PATH.'resolucao_de_questoes';
				$areaquestoes = INCLUDE_PATH.'area_de_questoes';


				if(isset($resolveu))
					echo "<p class='ja-resolveu'>$resolveu</p>";



				//TITULO DA QUESTAO
				echo "<p class='id-questao' title='ID da questão'>#$id_questao</p>";

				// echo "<a class='relatar' title='Relatar um problema' href='".INCLUDE_PATH."feedback'><i class='fas fa-exclamation-triangle'></i></a>";

				echo "<form action='".INCLUDE_PATH."feedback'>";
					echo "<input name='questao_relatada' value='$id_questao' type='hidden'>";

					echo "<button class='relatar' title='Relatar um problema com essa questão'><i class='fa-duotone fa-triangle-exclamation'></i></button>";
				echo "</form>";

				echo "<div class='titulo'>";
					echo "<h3>Questão sobre</h3>";
					echo "<h1>$sub_tema</h1>";
				echo "</div>";

				echo "<p><b>($vestibular $ano)</b> $enunciado</p>";
							
				if(!empty($imagem)) {
					echo '<div class="img-questao-container" title="Clique na imagem para ampliar">';
						echo '<i class="fa-solid fa-magnifying-glass lupa"></i>';
						echo '<img class="img-questao" src="data:image/jpeg;base64,'.base64_encode( $imagem ).'"/>';
					echo '</div>';
				}

				if(!empty($especial))
					echo "<p$especial</p>";
						
				if(!empty($pergunta))
					echo "<br><p><b>$pergunta</b></p>";

				echo "<form action='#gabaritos' method='POST' id='form_alternativas'>";

				if($tipo == 1) {
					echo "<div class='alternativa'>";
						echo "<input type='radio' id='lettler_A' name='lettler' value='A' class='input-radio' required>";
						echo "<label for='lettler_A'><b>A) </b> $alternativa_A</label>";
					echo "</div>";

					echo "<div class='alternativa'>";
						echo "<input type='radio' id='lettler_B' name='lettler' value='B' class='input-radio' required>";
						echo "<label for='lettler_B'><b>B) </b> $alternativa_B</label>";
					echo "</div>";

					echo "<div class='alternativa'>";
						echo "<input type='radio' id='lettler_C' name='lettler' value='C' class='input-radio' required>";
						echo "<label for='lettler_C'><b>C) </b> $alternativa_C</label>";
					echo "</div>";

					echo "<div class='alternativa'>";
						echo "<input type='radio' id='lettler_D' name='lettler' value='D' class='input-radio' required>";
						echo "<label for='lettler_D'><b>D) </b> $alternativa_D</label>";
					echo "</div>";

					if(!empty($alternativa_E)){
						echo "<div class='alternativa'>";
							echo "<input type='radio' id='lettler_E' name='lettler' value='E' class='input-radio' required>";
							echo "<label for='lettler_E'><b>E) </b> $alternativa_E</label>";	
						echo "</div>";
					}	
				}	
				elseif($tipo == 2){

					if(!empty($alternativa_A)) {
						echo "<div class='alternativa'>";
							echo "<b>A) </b> $alternativa_A<br>";
						echo "</div>";
					}

					if(!empty($alternativa_B)) {
						echo "<div class='alternativa'>";
							echo "<b>B) </b> $alternativa_B<br>";
						echo "</div>";
					}

					if(!empty($alternativa_C)) {
						echo "<div class='alternativa'>";
							echo "<b>C) </b> $alternativa_C<br>";
						echo "</div>";
					}
				}

				echo "<button class='botao-verificar botaofilled-verde' type='submit' value='1' id='btn-verificar' name='verifica'>Verificar</button>";
				echo "</form><div class='clear'></div>";

				if(isset($_POST["verifica"])){

					echo "<div id='gabaritos'>";

					if($tipo == 1){
						$resposta = $_POST["lettler"];

						if($gabarito == $resposta){
							echo "<p class='resposta green'><i class='fa-regular fa-check'></i> Parabéns! Você acertou a alternativa correta: letra <strong>$gabarito</strong></p>";
							$acertou = 's';
						}
						else{
							echo "<p class='resposta red'><i class='fas fa-times'></i> Infelizmente você errou, a alternativa correta era a letra <strong>$gabarito</strong>";
							$acertou = 'n'; 
						}

						if(!empty($explicacao))
							echo "<div class='comentario'><p><b>Comentário de professores e/ou Fontes:</b></p><br><p class='explicacao'><i>$explicacao</i></p></div>";
					}

					else{
						$resposta = 1;
						echo "<div class='resp_esperadas'>";
							echo "<p>Respostas esperadas:</p><br>";
						
							if(!empty($alternativa_D))
								echo "<strong>A)</strong> $alternativa_D<br><br>";
						
							if(!empty($alternativa_E))
								echo "<strong>B)</strong> $alternativa_E<br><br>";
						
							if(!empty($gabarito))
								echo "<strong>C)</strong> $gabarito<br>";
						
							if(!empty($explicacao))
								echo "<br><p><b>Comentário do profess@r/Fontes:</b><br><br>$explicacao</p>";
								
						echo "</div>";

						$acertou = 's';
					}
					echo "</div>";

					if(isset($_SESSION['id_usuario']))
						if(User::checksQuestionResolved($id_usuario, $id_questao) == 0)
							if(User::saveResolutionQuest($id_usuario, $id_questao, $resposta, $acertou, $id_materia) != 1)
								echo "<script>alert('Erro ao salvar o seu progresso, contate-nos para falar o que houve')</script>";	
				}

				echo "<a href='$areaquestoes' class='botaotofill-cinza botao-voltar'><i class='fa fa-arrow-left' aria-hidden='true'></i> Voltar para a Área de Questões</a>";
			?>
		</div>

		<?php
			if(!empty($imagem)) {
				echo "<div class='popup-img'>";
					echo '<i class="fa-regular fa-times popup-close"></i>';
					
					echo '<div class="img-container">';
						echo '<img src="data:image/jpeg;base64,'.base64_encode( $imagem ).'"/>';
					echo '</div>';

					echo '<p class="popup-orientacao">&ifr; Para desampliar a imagem, pressione o botão no canto superior direito.</p>';
				echo "<div>";
			}
		?>

		<script>
			document.querySelectorAll('div.questao img').forEach(image => {
				image.onclick = () => {
					document.querySelector('div.popup-img').style.display = 'block';
					document.querySelector('div.popup-img img').src = image.getAttribute('src');
				}
			})

			document.querySelectorAll('div.questao i.lupa').forEach(image => {
				image.onclick = () => {
					document.querySelector('div.popup-img').style.display = 'block';
				}
			})

			document.querySelector('div.popup-img i.popup-close').onclick = () => {
				document.querySelector('div.popup-img').style.display = 'none';
			}
		</script>
	</section>
</main>