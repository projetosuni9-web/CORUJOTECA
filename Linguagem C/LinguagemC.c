#include <stdio.h>
#include <string.h>

/*
=========================================================
GRUPO: DIEGO OLIVEIRA SILVA - RA 3026104921
JULIANE DE ALMEIDA CARVALHO- RA 3126101179
PAULA CAMILLY HUANCA LUCAS - RA 3026101339
RIAN FELIPE SALOMÃO FERRARI- RA 3026104920
SARA CRISTINA VIANA ROCHA- RA 3022201414

PROJETO: SISTEMA DE BIBLIOTECA CORUJOTECA
DISCIPLINA: PROJETO DE EXTENSÃO EM DESENVOLVIMENTO DE SOFTWARE
OBJETIVO:
- Cadastrar usuarios
- Fazer login
- Cadastrar livros
- Listar livros
- Comprar livros
- Registrar compras
=========================================================
*/

/* =========================
   CONSTANTES DO SISTEMA
   ========================= */
#define MAX_USUARIOS 100
#define MAX_LIVROS 100
#define MAX_COMPRAS 200

#define TIPO_ADMIN 1
#define TIPO_COMUM 2

/* =========================
   ESTRUTURAS
   ========================= */

/* Estrutura para armazenar os dados do usuario */
struct Usuario {
    char cpf[15];
    char email[100];
    char senha[30];
    int tipo;
};

/* Estrutura para armazenar os dados do livro */
struct Livro {
    int codigo;
    char titulo[100];
    char autor[100];
    int estoque;
    float preco;
};

/* Estrutura para armazenar os dados de uma compra */
struct Compra {
    char cpfUsuario[15];
    int codigoLivro;
    char tituloLivro[100];
    int quantidade;
    float valorUnitario;
    float valorTotal;
};

/* =========================
   VETORES (ARRAYS)
   ========================= */

/* Vetores para guardar varios dados do sistema */
struct Usuario usuarios[MAX_USUARIOS];
struct Livro livros[MAX_LIVROS];
struct Compra compras[MAX_COMPRAS];

/* Contadores para controlar quantos dados existem */
int totalUsuarios = 0;
int totalLivros = 0;
int totalCompras = 0;

/* =========================
   FUNCOES AUXILIARES
   ========================= */

/* Limpa o buffer do teclado */
void limparBuffer() {
    int c;
    while ((c = getchar()) != '\n' && c != EOF) {
        /* while usado para limpar caracteres restantes */
    }
}

/* Cria um usuario administrador padrao */
void criarAdminPadrao() {
    strcpy(usuarios[totalUsuarios].cpf, "11111111111");
    strcpy(usuarios[totalUsuarios].email, "admin@biblioteca.com");
    strcpy(usuarios[totalUsuarios].senha, "admin123");
    usuarios[totalUsuarios].tipo = TIPO_ADMIN;
    totalUsuarios++;
}

/* Valida se o CPF tem exatamente 11 caracteres */
int validarCPFSimples(char cpf[]) {
    if (strlen(cpf) == 11) {
        return 1;
    } else {
        return 0;
    }
}

/* Verifica se o CPF ja existe no sistema */
int cpfJaExiste(char cpf[]) {
    int i;

    for (i = 0; i < totalUsuarios; i++) {
        if (strcmp(usuarios[i].cpf, cpf) == 0) {
            return 1;
        }
    }

    return 0;
}

/* Busca um livro pelo codigo e retorna a posicao */
int buscarLivroPorCodigo(int codigo) {
    int i;

    for (i = 0; i < totalLivros; i++) {
        if (livros[i].codigo == codigo) {
            return i;
        }
    }

    return -1;
}

/* =========================
   FUNCOES DE USUARIO
   ========================= */

/* Cadastra um novo usuario comum */
void cadastrarUsuario() {
    char cpf[15];

    printf("\n===== CADASTRO DE USUARIO =====\n");

    if (totalUsuarios >= MAX_USUARIOS) {
        printf("Limite de usuarios atingido.\n");
        return;
    }

    printf("Digite o CPF (somente numeros): ");
    scanf("%14s", cpf);

    /* Estrutura de decisao com if/else */
    if (validarCPFSimples(cpf) == 0) {
        printf("CPF invalido. Deve conter 11 digitos.\n");
        return;
    }

    if (cpfJaExiste(cpf) == 1) {
        printf("Erro: ja existe usuario com esse CPF.\n");
        return;
    }

    strcpy(usuarios[totalUsuarios].cpf, cpf);

    printf("Digite o email: ");
    scanf("%99s", usuarios[totalUsuarios].email);

    printf("Digite a senha: ");
    scanf("%29s", usuarios[totalUsuarios].senha);

    usuarios[totalUsuarios].tipo = TIPO_COMUM;

    totalUsuarios++;

    printf("Usuario cadastrado com sucesso!\n");
}

/* Faz login no sistema */
int fazerLogin() {
    char cpf[15];
    char senha[30];
    int i;

    printf("\n===== LOGIN =====\n");
    printf("CPF: ");
    scanf("%14s", cpf);

    printf("Senha: ");
    scanf("%29s", senha);

    for (i = 0; i < totalUsuarios; i++) {
        /* Uso de operador relacional (==) e logico (&&) */
        if (strcmp(usuarios[i].cpf, cpf) == 0 &&
            strcmp(usuarios[i].senha, senha) == 0) {
            printf("Login realizado com sucesso!\n");
            return i;
        }
    }

    printf("CPF ou senha incorretos.\n");
    return -1;
}

/* Lista todos os usuarios */
void listarUsuarios() {
    int i;

    printf("\n===== LISTA DE USUARIOS =====\n");

    if (totalUsuarios == 0) {
        printf("Nenhum usuario cadastrado.\n");
        return;
    }

    for (i = 0; i < totalUsuarios; i++) {
        printf("\nUsuario %d\n", i + 1);
        printf("CPF: %s\n", usuarios[i].cpf);
        printf("Email: %s\n", usuarios[i].email);

        if (usuarios[i].tipo == TIPO_ADMIN) {
            printf("Tipo: Administrador\n");
        } else {
            printf("Tipo: Usuario comum\n");
        }
    }
}

/* =========================
   FUNCOES DE LIVRO
   ========================= */

/* Cadastra um novo livro */
void cadastrarLivro() {
    int codigo;

    printf("\n===== CADASTRO DE LIVRO =====\n");

    if (totalLivros >= MAX_LIVROS) {
        printf("Limite de livros atingido.\n");
        return;
    }

    printf("Digite o codigo do livro: ");
    scanf("%d", &codigo);

    if (buscarLivroPorCodigo(codigo) != -1) {
        printf("Erro: ja existe um livro com esse codigo.\n");
        return;
    }

    livros[totalLivros].codigo = codigo;

    limparBuffer();

    printf("Digite o titulo do livro: ");
    fgets(livros[totalLivros].titulo, sizeof(livros[totalLivros].titulo), stdin);
    livros[totalLivros].titulo[strcspn(livros[totalLivros].titulo, "\n")] = '\0';

    printf("Digite o autor do livro: ");
    fgets(livros[totalLivros].autor, sizeof(livros[totalLivros].autor), stdin);
    livros[totalLivros].autor[strcspn(livros[totalLivros].autor, "\n")] = '\0';

    printf("Digite o estoque: ");
    scanf("%d", &livros[totalLivros].estoque);

    printf("Digite o preco: ");
    scanf("%f", &livros[totalLivros].preco);

    totalLivros++;

    printf("Livro cadastrado com sucesso!\n");
}

/* Lista todos os livros cadastrados */
void listarLivros() {
    int i;

    printf("\n===== CATALOGO DE LIVROS =====\n");

    if (totalLivros == 0) {
        printf("Nenhum livro encontrado.\n");
        return;
    }

    for (i = 0; i < totalLivros; i++) {
        printf("\nLivro %d\n", i + 1);
        printf("Codigo: %d\n", livros[i].codigo);
        printf("Titulo: %s\n", livros[i].titulo);
        printf("Autor: %s\n", livros[i].autor);
        printf("Estoque: %d\n", livros[i].estoque);
        printf("Preco: R$ %.2f\n", livros[i].preco);
    }
}

/* =========================
   FUNCOES DE COMPRA
   ========================= */

/* Realiza a compra de um ou mais exemplares de um livro */
void comprarLivro(int indiceUsuario) {
    int codigo;
    int quantidade;
    int indiceLivro;
    float valorTotal;

    printf("\n===== COMPRA DE LIVRO =====\n");

    if (totalLivros == 0) {
        printf("Nao ha livros cadastrados.\n");
        return;
    }

    if (totalCompras >= MAX_COMPRAS) {
        printf("Limite de compras atingido.\n");
        return;
    }

    listarLivros();

    printf("\nDigite o codigo do livro que deseja comprar: ");
    scanf("%d", &codigo);

    indiceLivro = buscarLivroPorCodigo(codigo);

    if (indiceLivro == -1) {
        printf("Livro nao encontrado.\n");
        return;
    }

    printf("Digite a quantidade que deseja comprar: ");
    scanf("%d", &quantidade);

    /* Validacao usando operadores relacionais e logicos */
    if (quantidade <= 0) {
        printf("Quantidade invalida.\n");
        return;
    }

    if (livros[indiceLivro].estoque < quantidade) {
        printf("Estoque insuficiente.\n");
        return;
    }

    /* Operadores aritmeticos */
    valorTotal = livros[indiceLivro].preco * quantidade;

    /* Atualiza o estoque */
    livros[indiceLivro].estoque = livros[indiceLivro].estoque - quantidade;

    /* Registra a compra */
    strcpy(compras[totalCompras].cpfUsuario, usuarios[indiceUsuario].cpf);
    compras[totalCompras].codigoLivro = livros[indiceLivro].codigo;
    strcpy(compras[totalCompras].tituloLivro, livros[indiceLivro].titulo);
    compras[totalCompras].quantidade = quantidade;
    compras[totalCompras].valorUnitario = livros[indiceLivro].preco;
    compras[totalCompras].valorTotal = valorTotal;

    totalCompras++;

    printf("\nCompra realizada com sucesso!\n");
    printf("CPF do usuario: %s\n", usuarios[indiceUsuario].cpf);
    printf("Livro comprado: %s\n", livros[indiceLivro].titulo);
    printf("Quantidade: %d\n", quantidade);
    printf("Valor total: R$ %.2f\n", valorTotal);
}

/* Lista o historico de compras */
void listarCompras() {
    int i;

    printf("\n===== HISTORICO DE COMPRAS =====\n");

    if (totalCompras == 0) {
        printf("Nenhuma compra realizada.\n");
        return;
    }

    for (i = 0; i < totalCompras; i++) {
        printf("\nCompra %d\n", i + 1);
        printf("CPF do usuario: %s\n", compras[i].cpfUsuario);
        printf("Codigo do livro: %d\n", compras[i].codigoLivro);
        printf("Titulo do livro: %s\n", compras[i].tituloLivro);
        printf("Quantidade: %d\n", compras[i].quantidade);
        printf("Valor unitario: R$ %.2f\n", compras[i].valorUnitario);
        printf("Valor total: R$ %.2f\n", compras[i].valorTotal);
    }
}

/* =========================
   MENUS
   ========================= */

/* Menu do administrador */
void menuAdmin(int indiceUsuario) {
    int opcao;

    do {
        printf("\n===== MENU ADMINISTRADOR =====\n");
        printf("Bem-vindo, admin CPF %s\n", usuarios[indiceUsuario].cpf);
        printf("1 - Cadastrar livro\n");
        printf("2 - Listar livros\n");
        printf("3 - Listar usuarios\n");
        printf("4 - Listar compras\n");
        printf("5 - Sair\n");
        printf("Escolha uma opcao: ");
        scanf("%d", &opcao);

        /* Uso de switch conforme a exigencia */
        switch (opcao) {
            case 1:
                cadastrarLivro();
                break;
            case 2:
                listarLivros();
                break;
            case 3:
                listarUsuarios();
                break;
            case 4:
                listarCompras();
                break;
            case 5:
                printf("Saindo do menu do administrador...\n");
                break;
            default:
                printf("Opcao invalida.\n");
        }

    } while (opcao != 5);
}

/* Menu do usuario comum */
void menuUsuario(int indiceUsuario) {
    int opcao;

    do {
        printf("\n===== MENU USUARIO =====\n");
        printf("Bem-vindo, usuario CPF %s\n", usuarios[indiceUsuario].cpf);
        printf("1 - Listar livros\n");
        printf("2 - Comprar livro\n");
        printf("3 - Sair\n");
        printf("Escolha uma opcao: ");
        scanf("%d", &opcao);

        switch (opcao) {
            case 1:
                listarLivros();
                break;
            case 2:
                comprarLivro(indiceUsuario);
                break;
            case 3:
                printf("Saindo do menu do usuario...\n");
                break;
            default:
                printf("Opcao invalida.\n");
        }

    } while (opcao != 3);
}

/* =========================
   FUNCAO PRINCIPAL
   ========================= */

int main() {
    int opcao;
    int indiceUsuarioLogado;

    /* Cria um administrador padrao para teste */
    criarAdminPadrao();

    do {
        printf("\n===================================\n");
        printf("      SISTEMA DA BIBLIOTECA CORUJOTECA\n");
        printf("===================================\n");
        printf("1 - Cadastrar usuario\n");
        printf("2 - Fazer login\n");
        printf("3 - Listar catalogo\n");
        printf("4 - Sair\n");
        printf("Escolha uma opcao: ");
        scanf("%d", &opcao);

        switch (opcao) {
            case 1:
                cadastrarUsuario();
                break;

            case 2:
                indiceUsuarioLogado = fazerLogin();

                if (indiceUsuarioLogado != -1) {
                    if (usuarios[indiceUsuarioLogado].tipo == TIPO_ADMIN) {
                        menuAdmin(indiceUsuarioLogado);
                    } else {
                        menuUsuario(indiceUsuarioLogado);
                    }
                }
                break;

            case 3:
                listarLivros();
                break;

            case 4:
                printf("Encerrando o sistema...\n");
                break;

            default:
                printf("Opcao invalida.\n");
        }

    } while (opcao != 4);

    return 0;
}
