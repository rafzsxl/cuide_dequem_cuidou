# Estilização do site "Cuide de quem cuidou"
 
## Objetivo
Criar a estilização visual do site "Cuide de quem cuidou", com base no que está descrito em briefing.md e na documentação do projeto. Comunique-se em português claro.
 
## REGRA ABSOLUTA — leia primeiro
**O único arquivo que você pode modificar é `style/style.css`.**
 
- NÃO edite, renomeie, mova, apague nem sobrescreva nenhum outro arquivo do projeto (HTML, PHP, imagens, briefing.md, README, documentação, configurações, este AGENTS.md etc.).
- Crie arquivos novos, mas não de código, e sim de relatório e teste, nem de evidência. Se precisar registrar algo (resultado, limitação, dúvida), escreva na sua resposta nos arquivos, para isto crie um diretório especifico denominado /codex.
- NÃO adicione `style="..."` nem `<style>` em HTML. NÃO adicione, remova ou troque classes, IDs ou tags. NÃO insira `<link>` ou `<script>`.
- NÃO instale dependências, NÃO rode formatadores, linters com correção automática ou qualquer comando que possa reescrever arquivos do projeto.
- Se algo que o foi pedidido não puder ser feito apenas com CSS, NÃO contorne alterando outro arquivo. Explique a limitação e proponha uma alternativa que use somente `style/style.css`.
## Antes de começar (somente leitura)
1. Leia BRIEFING.md por completo: público-alvo, tom, identidade visual, cores, referências, funções do site e restrições.
2. Leia a documentação existente do projeto (README, pasta docs/ e similares), se houver.
3. Leia os arquivos HTML para descobrir a estrutura, as classes e os IDs que já existem. A estilização deve se adaptar ao HTML como ele está, e não o contrário.
4. Leia o `style/style.css` atual e preserve o que já estiver funcionando, a menos que o briefing peça mudança.
5. Se o briefing deixar em aberto algo essencial para o visual (por exemplo, cores, tom ou público), pergunte antes de estilizar. Não invente identidade visual que contradiga o briefing.
6. Visualize a Prototipagem feita no excalidraw em /images/proto_excalidraw.png
## Diretrizes de estilização
- Reflita o propósito e o tom do projeto: o site trata de acolhimento e cuidado com quem cuida, então priorize sensação de calma, clareza e acolhimento, conforme o briefing indicar.
- Use a solução mais simples: CSS puro, variáveis CSS (`:root`) para cores, fontes e espaçamentos, e seletores que correspondam ao HTML existente.
- Fontes: prefira fontes do sistema. Só use fonte externa (via `@import` dentro do próprio CSS) se o briefing pedir ou eu aprovar, e informe isso.
- Acessibilidade: contraste de texto suficiente (mínimo WCAG AA), tamanho de fonte legível, estados visíveis de foco (`:focus-visible`), áreas de toque confortáveis em botões e links, e respeito a `prefers-reduced-motion` em animações.
- Portabilidade: Não se trata de um site real, portanto, não há a necessidade de fazer a exportação da aplicação e nem do style para telemóveis. Apenas para o site no Computador
- Mantenha o CSS organizado: seções comentadas (variáveis, base, layout, componentes, utilitários, media queries) e sem regras duplicadas ou mortas.
- Não use `!important` sem necessidade clara.
- Não remova conteúdo visível nem esconda elementos que o HTML mostra e que o briefing considera importantes.
## Verificação
- Antes de terminar, confirme que apenas `style/style.css` foi modificado (por exemplo, com `git status` e `git diff --stat`, se o projeto usar git). Se qualquer outro arquivo aparecer alterado, desfaça a alteração nesse arquivo e avise o aluno.
- Use apenas dados fictícios em qualquer interação com formulários. Não envie mensagens reais.
## Entrega
Ao terminar, responda nos arquivos, em português, com:
1. O que foi estilizado e as principais decisões visuais (cores, tipografia, layout), ligadas ao briefing.
2. Confirmação de que somente `style/style.css` foi alterado.
3. O que foi verificado e o que não foi possível verificar.
4. Limitações que exigiriam mudança em outros arquivos e que o aluno deve decidir se quer fazer por conta própria.
A validação final do resultado por mim; seu relatório não a substitui.
