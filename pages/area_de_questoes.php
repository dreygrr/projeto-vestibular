<?php
	$vests = Questao::selectExams();
	$temas = Questao::selectThemes();
	$materias = Adm::getSubject();

	$filtros = ["tema", "ano", "partenome", "vestibular", "qtd_quest", "materia"];

	$filtro_exist = false;

	if(isset($_POST['btn-reset-filtro']))
		foreach ($filtros as $campo) 
			$_SESSION[$campo] = "";
	
	foreach ($filtros as $campo) {
		if(!empty($_POST[$campo]))
			$_SESSION[$campo] = $_POST[$campo];

		if(!empty($_SESSION[$campo]))
			$filtro_exist = true;
	}


	Questao::filterQuestions($_SESSION['tema'], $_SESSION['ano'], $_SESSION['partenome'], $_SESSION['vestibular'], $_SESSION['materia']);	

	setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
?>

<main>
    <section class="area-de-questoes" id="comeco">
		<div class="center">	
			<h3 class="titulo">Área de Questões</h3>

			<form method="POST" action="<?php echo INCLUDE_PATH; ?>area_de_questoes" id="filtro">

				<input type="text" name="partenome" id="pesquisar-input" placeholder="Pesquisar pelo enunciado" maxlength="200">

				<select name="vestibular" id="vestibular-input" class="w25">
					<option value="">Vestibular</option>
					<?php
						foreach ($vests as $key => $vest) {
							$nome = $vest["descricao"];
							echo "<option value='$nome'>$nome</option>";
						}
					?>
					<option value='UNICAMP'>UNICAMP Geral</option>
				</select>

				<select name='ano' id='ano-input' class='w25'>
					<option value=''>Ano</option>
					<?php
						$ano = date('Y');
						$ano++;

						while($ano > 1900){
							echo "<option value='$ano'>$ano</option>";
							$ano = $ano - 1;
						}
					?>
				</select>

				<select name='materia' id='materia-input' class='w25'>
					<option value=''>Matéria</option>
					<?php
						foreach ($materias as $key => $materia) {
							$nome = $materia["nome"];
							echo "<option value='$nome'>$nome</option>";
						}
					?>
				</select>

				<select name='qtd_quest' id='qtd_quest-input' class='w25'>
					<option value=''>Nº de questões</option>
					<option value='4'>4 Questões</option>
					<option value='6'>6 Questões</option>
					<option value='10'>10 Questões</option>
					<option value='20'>20 Questões</option>
				</select>

				<select name='tema' id='tema-input'>
					<option value=''>Temas</option>
					<?php
						foreach ($temas as $key => $tema) {
							$nome = $tema["descricao"];
							echo "<option value='$nome'>$nome</option>";
						}
					?>
				</select>

				<div class="buttons">
					<button type="submit" value="Pesquisar" class="botaofilled-azul btn-filtrar botao-filtrar"><i class="fa-solid fa-filter"></i> Pesquisar</button>
				</div>
			</form>

			<form method="POST" action="<?php echo INCLUDE_PATH; ?>area_de_questoes" id="removerfiltro">
				<!-- <button type="submit" value="1" name="btn-reset-filtro"><i class="fa-solid fa-filter-circle-xmark"></i> Limpar filtros</button> -->
				<button type="submit" value="1" name="btn-reset-filtro" class="botaotofill-vermelho botao-limpar"><i class="fa-solid fa-filter-circle-xmark"></i> Limpar filtros</button>
			</form>

			<?php	
				if($filtro_exist){		
			?>
				<div class="filtros_usados">
					<h3>Filtros ativos: </h3>
					<?php

						foreach ($filtros as $campo)
							if(!empty($_SESSION[$campo]) and $campo != "partenome"){
								
								$nome_campo = str_replace("_", " ", $campo);
								echo "<p class='p_filtro'>".ucfirst($nome_campo).": <b>".$_SESSION[$campo]."</b></p>";
							}
					?>
							
				</div>

			<?php
				}
			?>

			<div class="center resultados">
				<?php
					if (!empty($_SESSION['qtd_quest'])) 
						$total_reg = $_SESSION['qtd_quest'];
					else
						
						//define o tanto de registros a serem exibidos por pagina
						$total_reg = 4;

					//comeca na pagina 1
					if (!$pagina)
						$pc = 1;
					else
						$pc = $pagina;

					//define o valor da limitacao de busca
					$inicio = $pc - 1;
					$inicio = $inicio * $total_reg;

					/*Exibira os dados do (inicio ao fim)*/
					$resultadoFiltro = Questao::resultFilter($inicio, $total_reg);
					$totalResultadoFiltro = Questao::totalResultFilter();

					$tr = count($totalResultadoFiltro);// verifica o número total de registros

					
					echo "<p class='total_resultados right'>$tr resultados encontrados</p><div class='clear'></div>";

					$tp = $tr / $total_reg;// verifica o número total de páginas

					if(count($resultadoFiltro) > 0){
						foreach ($resultadoFiltro as $key => $questao) {

							echo "<div class='questao'>";
								$vestibular = $questao['vestibular'];
								$ano = $questao['ano'];
								$imagem = $questao['imagem'];
								$enunciado = $questao['enunciado'];
								$especial = $questao['especial'];
								$pergunta = $questao['pergunta'];
								$id = $questao['id'];

								$alternativa_A = $questao['alternativa_a'];
								$alternativa_B = $questao['alternativa_b'];
								$alternativa_C = $questao['alternativa_c'];
								$alternativa_D = $questao['alternativa_d'];
								$alternativa_E = $questao['alternativa_e'];
								
								echo "<strong>($vestibular $ano)</strong> $enunciado";
								
								if(!empty($imagem)){
									echo "<br><br>";
									echo '<img src="data:image/jpeg;base64,'.base64_encode( $imagem ).'"/>';
									echo "<div class='clear'></div>";
								}

								if(!empty($especial))
									echo "<br><br>$especial<br>";
								if(!empty($pergunta))
									echo "<br><b>$pergunta</b>";	

								echo "<div class='alternativas'>";
									echo "<p><strong>A) </strong>$alternativa_A</p>";
									echo "<p><strong>B) </strong>$alternativa_B</p>";

									if (!empty($alternativa_C)) {
										echo "<p><strong>C) </strong>$alternativa_C</p>";
										echo "<p><strong>D) </strong>$alternativa_D</p>";

										if (!empty($alternativa_E))
											echo "<p><strong>E) </strong>$alternativa_E</p>";
									}
								echo "</div>";

								$resolucao = INCLUDE_PATH.'resolucao_de_questoes';

								echo "<form class='right entrar_questao' action='$resolucao' method='POST'><button type='submit' value='$id' class='btn-resolver-questao' name='id_questao'><b>Responder <i class='fa fa-arrow-right' aria-hidden='true'></i></b></button></form><div class='clear'></div>";

							echo "</div>";
						}
								
						$anterior = $pc - 1;
						$proximo = $pc + 1;	
						
						if($anterior > 1)
							$anterior = INCLUDE_PATH.'area_de_questoes-'.$anterior;
						else
							$anterior = INCLUDE_PATH.'area_de_questoes';
				
						$proximo = 	INCLUDE_PATH.'area_de_questoes-'.$proximo;
						$inicio = 	INCLUDE_PATH.'area_de_questoes';
				
						echo "<div class='posicao-pagina'>";
							if ($pc > 1) {
								echo "<div class='anterior parte'>";
									echo "<a href='$anterior' id='paginacao-anterior'><i class='fa fa-arrow-left' aria-hidden='true'></i> Anterior</a>";
								echo "</div>";

								echo "<div class='inicio meio parte'>";
									echo "<a href='$inicio' id='paginacao-inicio'><i class='fa-solid fa-rotate-right'></i> Questões iniciais</a>";
								echo "</div>";
										
								if ($pc < $tp) {
									echo "<div class='proxima parte'>";
										echo "<a href='$proximo' id='paginacao-proxima'>Próxima <i class='fa fa-arrow-right' aria-hidden='true'></i></a>";
									echo "<div>";
								}
							} else {
								echo "<div class='parte'></div>";

								echo "<div class='inicio parte'>";
									echo "<a href='$inicio' id='paginacao-inicio'><i class='fa-solid fa-rotate-right'></i> Questões iniciais</a>";
								echo "</div>";
										
								if ($pc < $tp) {
									echo "<div class='proxima parte'>";
										echo "<a href='$proximo' id='paginacao-proxima'>Próxima <i class='fa fa-arrow-right' aria-hidden='true'></i></a>";
									echo "<div>";
								}
							}
						echo "</div>";
					}
				?>
			</div>
		</div>

		<div class="outros-links">
			<a class="voltar-topo" href="#comeco"><i class="fa-solid fa-caret-up"></i> Topo da página <i class="fa-solid fa-caret-up"></i></a>
		</div>
	</section>
</main>
