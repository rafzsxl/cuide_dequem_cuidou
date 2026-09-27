# Documentação do Projeto Integrador 

## 1.0 Introdução

### 1.1 Propósito
#### Este documento especifica os Requisitos de Software para a ONG Cuide de Quem Cuidou (CDQC), com o objetivo de orientar o desenvolvimento, a validação e a manutenção do sistema.

## 1.2 Escopo
#### O site controlará:
- Cadastro, autenticação e edição de dados de usuários (voluntários, doadores e administradores);
- Publicação, edição e remoção de campanhas de arrecadação da CDQC, incluindo upload de imagens;
- Envio de doações dos usuários voluntários (apenas teórico, sem integração real de API de pagamento);
- Cadastro de interessados em voluntariado;
- Exibição de relatórios de transparência institucional (conteúdo estático, sem persistência em banco);
- Exibição de conteúdo institucional (Quem Somos, Parceiros, Contato)

## 1.3 Definições/Abreviações
- **ONG**: Organização Não Governamental;
- **CDQC**: Cuide De Quem Cuidou;
- **RF**: Requisito Funcional;
- **RN**: Regra de Negócio;
- **RNF**: Requisito Não Funcional;
- **SP**: Sistema de Pagamento;
- **ADM**: Administrador do sistema (colaborador autorizado da CDQC);
- **LGPD**: Lei Geral de Proteção de Dados (Lei nº 13.709/2018)

---

## 2.0 Descrição Geral

### 2.1 Perspectiva do Produto
#### O CDQC é um sistema web multiusuário, acessado via navegador, que permite a interação entre doadores, voluntários e administradores da ONG. O sistema persiste seus dados de forma estruturada em um banco de dados PostgreSQL e é desenvolvido em PHP, seguindo arquitetura cliente-servidor.

### 2.2 Funções do Produto
- Permitir cadastro, login, logout e edição de dados de usuários;
- Permitir que usuários visualizem campanhas de arrecadação;
- Permitir que usuários voluntários realizem doações (fluxo teórico);
- Permitir que usuários se cadastrem como voluntários;
- Exibir conteúdo de transparência e prestação de contas;
- Permitir que administradores criem, editem e removam campanhas, incluindo upload de imagens;
- Exibir conteúdo institucional (missão, parceiros, contato)

### 2.3 Características dos Usuários
| Tipo de Usuário | Nível Técnico | Funções Principais |
|------------------------------|--------------|--------------------------------------|
| Visitante (não logado) | Básico | Navegar pelo site, visualizar campanhas, transparência e conteúdo institucional |
| Usuário comum (não voluntário) | Básico | Cadastrar-se, fazer login, editar perfil, cadastrar-se como voluntário |
| Voluntário | Básico | Todas as funções do usuário comum, além de realizar doações |
| Administrador (ADM) | Intermediário | Criar/editar/remover campanhas (com upload de imagem), gerenciar usuários |

### 2.4 Restrições
- O sistema deve seguir as diretrizes de acessibilidade [WCAG 2.1](https://guia-wcag.com/), nível AA;
- O sistema deve ser desenvolvido em PHP com banco de dados PostgreSQL;
- O conteúdo das páginas de Transparência e Parceiros será estático (fixo no código), sem persistência em banco de dados;
- O sistema deve estar em conformidade com a LGPD no tratamento de dados pessoais sensíveis (CPF, data de nascimento)

---

## 3.0 Requisitos Funcionais

### **3.1 Requisitos Funcionais (RF)**
#### **Descrição:** O que o sistema deve fazer

### - RF001 - Cadastro de Usuário
**Descrição:** O sistema deve permitir que visitantes se cadastrem informando nome, e-mail, telefone, CPF e senha, através da página `sign_up.php`.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RF002 - Login de Usuário
**Descrição:** O sistema deve permitir que usuários cadastrados façam login informando e-mail e senha, através da página `login.php`. Usuários sem conta devem ser direcionados ao cadastro através de um link na própria página.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RF003 - Logout de Usuário
**Descrição:** O sistema deve permitir que o usuário encerre sua sessão através do botão "Fazer Logout" disponível na página `profile.php`.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RF004 - Visualização de Perfil
**Descrição:** O sistema deve exibir na página `profile.php` as informações do usuário logado, como e-mail cadastrado.
**Prioridade:** Média
**Versão:** 1.0
**Data:** 2026-09-24

### - RF005 - Edição de Perfil
**Descrição:** O sistema deve permitir que o usuário edite seus dados cadastrais (e-mail, CPF, senha e telefone) através da página `edit.php`.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

### - RF006 - Listagem de Campanhas
**Descrição:** O sistema deve exibir na página `campaigns.php` a lista de campanhas ativas da CDQC, com título, descrição e imagem.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RF007 - Criação de Campanha (ADM)
**Descrição:** O sistema deve permitir que o usuário Administrador adicione uma nova campanha, incluindo upload de imagem, através do botão "ADICIONAR" na página `campaigns.php`, visível apenas quando `User == ADM`.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RF008 - Edição de Campanha (ADM)
**Descrição:** O sistema deve permitir que o Administrador edite os dados de uma campanha existente (título, descrição e imagem) através do botão "Editar" na página `campaigns.php`.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

### - RF009 - Remoção de Campanha (ADM)
**Descrição:** O sistema deve permitir que o Administrador remova uma campanha existente através do botão "Remover" na página `campaigns.php`.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

### - RF010 - Envio de Doação (Teórico)
**Descrição:** O sistema deve permitir que o usuário voluntário simule o envio de uma doação através da página `donate.php`, sem integração real com sistema de pagamento.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RF011 - Cadastro de Voluntário
**Descrição:** O sistema deve permitir que o usuário se registre como voluntário, informando nome completo, CPF e data de nascimento, através da página `volunteer.php`.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RF012 - Visualização de Transparência
**Descrição:** O sistema deve exibir na página `transparency.php` o total arrecadado e um link para download do relatório de gastos e receitas em formato PDF.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

### - RF013 - Visualização Institucional (Quem Somos)
**Descrição:** O sistema deve exibir na página `about.php` a missão, visão, valores e história da CDQC.
**Prioridade:** Média
**Versão:** 1.0
**Data:** 2026-09-24

### - RF014 - Visualização de Parceiros
**Descrição:** O sistema deve exibir na página `partners.php` um carrossel de imagens com projetos e instituições parceiras da CDQC.
**Prioridade:** Baixa
**Versão:** 1.1
**Data:** 2026-09-26

### - RF015 - Página de Contato
**Descrição:** O sistema deve exibir na página `contact.php` as informações de contato da CDQC (telefone, e-mail, Instagram e endereço do centro de acolhimento).
**Prioridade:** Média
**Versão:** 1.1
**Data:** 2026-09-26

### - RF016 - Navegação por Menu Hambúrguer
**Descrição:** O sistema deve exibir um menu hambúrguer responsivo, contendo os links: Quem Somos, Campanhas, Transparência e Parceiros.
**Prioridade:** Média
**Versão:** 1.0
**Data:** 2026-09-24

---

### **3.2 Regras de Negócio (RN)**
#### **Descrição:** Critérios de excelência exigidos pelo cliente ou mercado para o sistema.

### - RN001 - Confirmação de Cadastro
**Descrição:** Todo cadastro de usuário deve ser validado antes da liberação de acesso ao sistema (ex.: confirmação de e-mail).
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RN002 - Restrição de Ações Administrativas
**Descrição:** Apenas usuários do tipo Administrador (ADM) podem criar, editar ou remover campanhas.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RN003 - Doação Teórica sem Cobrança Real
**Descrição:** O fluxo de doação não deve processar nenhuma cobrança financeira real, servindo apenas como demonstração funcional do sistema.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RN004 - Sessão Única por Usuário
**Descrição:** O sistema deve encerrar a sessão do usuário após logout, exigindo novo login para acessar áreas restritas (perfil, doação, voluntariado).
**Prioridade:** Média
**Versão:** 1.0
**Data:** 2026-09-24

### - RN005 - Doação Restrita a Voluntários
**Descrição:** O sistema deve permitir o envio de doações apenas para usuários já cadastrados como voluntários. Usuários não voluntários devem ser direcionados ao cadastro de voluntariado antes de doar.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

### - RN006 - Validação de Upload de Imagem
**Descrição:** O sistema deve aceitar, no upload de imagens de campanhas, apenas arquivos dos tipos JPG, PNG ou WEBP, com tamanho máximo de 5MB.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

### - RN007 - Exibição Condicional de Voluntariado
**Descrição:** O botão "Voluntariar-se" não deve ser exibido para usuários que já estejam cadastrados como voluntários.
**Prioridade:** Média
**Versão:** 1.1
**Data:** 2026-09-26

### - RN008 - Redirecionamento de Visitante
**Descrição:** Usuários não autenticados que tentarem doar ou se voluntariar devem ser redirecionados à página de login antes de prosseguir.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

---

### **3.3 Requisitos Não-Funcionais (RNF)**
#### **Descrição:** Como o sistema deve funcionar

### - RNF001 - Acessibilidade
**Descrição:** O sistema deve seguir as diretrizes WCAG 2.1 nível AA, garantindo contraste adequado de texto considerando o público idoso.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RNF002 - Tecnologia
**Descrição:** O sistema deve ser desenvolvido em PHP, com persistência de dados em banco PostgreSQL.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RNF003 - Segurança de Dados
**Descrição:** As informações pessoais dos usuários devem ser armazenadas de forma segura, evitando exposição de dados sensíveis (senhas, e-mails, CPF).
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RNF004 - Usabilidade
**Descrição:** A interface deve utilizar textos grandes, botões claramente identificáveis e navegação simplificada, considerando o público idoso como usuário final indireto.
**Prioridade:** Alta
**Versão:** 1.0
**Data:** 2026-09-24

### - RNF005 - Conformidade com a LGPD
**Descrição:** O sistema deve tratar dados pessoais sensíveis (CPF, data de nascimento) em conformidade com a Lei Geral de Proteção de Dados ([LGPD](https://www.planalto.gov.br/ccivil_03/_ato2015-2018/2018/lei/l13709.htm)), armazenando-os de forma segura e utilizando-os apenas para as finalidades do sistema.
**Prioridade:** Alta
**Versão:** 1.1
**Data:** 2026-09-26

---

## 4.0 Controle de Versão
### Histórico de Versão
|  Versão  |    Data    | Modificações |
|---------:|:----------:|:--------------|
|    1.0   | 2026-09-18 | Estruturação Inicial do Projeto |
|    1.1   | 2026-09-20 | Refinamento do escopo e objetivos do projeto |
|    1.2   | 2026-09-24 | Adicionando Arquivos para Cadastro, Login e Logout |
|    1.3   | 2026-09-24 | Preenchimento completo de RF, RN e RNF |
|    1.4   | 2026-09-26 | Finalização da Documentação & Lançamento para a Núvem|

---

## 5.0 Utilização de IA
### Retrospecto do Uso de IA
|  IA |    Data    | Intenção|
|---------:|:----------:|:--------------|
| CLAUDE | 2026-09-20 | Dar nome à ONG |
| GEMINI | 2026-09-20 | Gerar logo da CDQC |
| CLAUDE | 2026-09-22 | Gerar perguntas para estruturar o briefing |
