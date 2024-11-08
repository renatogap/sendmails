<?php

namespace Database\Seeders;

use App\Models\Entity\TemplateEmail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TemplateEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('template_email')->delete();

        $templates = [
            [
                'id' => 1,
                'nome_template' => '1) E-MAIL DE OBRIGADO + PESQUISA',
                'assunto' => 'Preciso da sua ajuda',
                'descricao' => '<p>Fala Dev,</p>
                            <p>
                                Aqui é o Renato Pereira, e eu estou passando para te dar os parabéns por ter realizado a sua inscrição para o <strong>PROGRAMADOR 10x</strong>.
                            </p>
                            <p>
                                Tenho certeza que nesse evento você vai aprender a como sair do zero e se tornar um programador profissional de forma acelerada, e conquistar a sua vaga no mercado da programação. Você vai ficar surpreso com muita coisa.
                            </p>
                            <p>
                                Nesse exato momento, eu e a minha equipe estamos cuidando de todos os preparativos para realizar o Evento Programador 10x.
                            </p>
                            <p>
                                Estamos nos esforçando ao máximo para produzir o melhor conteúdo pra você e é exatamente por isso que eu preciso da sua ajuda.
                            </p>
                            <p>
                                Para ser mais exato, preciso que você me ajude  com duas coisas muito importantes. 
                            </p>
                            <p>
                                A primeira é:  eu gostaria muito de saber quais são as principais dificuldades e necessidades que você tem enfrentando neste momento para aprender a programar.
                            </p>
                            <p>
                                A sua resposta vai me ajudar a garantir que esse evento supere as suas expectativas.
                            </p>
                            <p>
                                Logo abaixo, tem um link com uma pesquisa pra você responder. 
                            </p>
                            <p>
                                Com base nas suas respostas, pode ser que eu consiga  adaptar ou até mesmo produzir um conteúdo específico para você. Então reserve um tempinho na sua agenda  e responda essa pesquisa com o máximo de atenção possível, ok?
                            </p>
                            <p>
                                [<a href="https://docs.google.com/forms/d/e/1FAIpQLScikTysFtq4t3dV2Et90y02Y-4QxTbyFhZWaHELVZX6TBVadA/viewform?usp=pp_url">CONFIRMAR INSCRIÇÃO - PESQUISA</a>]
                            </p>
                            <p>
                                E o meu segundo pedido é o seguinte.
                            </p>
                            <p>
                                Da última vez que eu fiz um evento assim, muitas pessoas ficaram chateadas porque não receberam meus e-mails e, por conta disso, não tiveram acesso a todos os conteúdos que eu enviei.
                            </p>
                            <p>
                                Dessa vez, eu quero ter a certeza que minhas mensagens vão chegar até você. Mas pra isso, eu preciso  que você responda à pesquisa que eu coloquei ali em cima e depois responda este e-mail aqui falando assim:
                            </p>
                            <p>
                                <strong>"Eu recebi o e-mail e já respondi a pesquisa".</strong>
                            </p>
                            <p>
                                Assim, eu vou saber que está tudo ok com seu acesso e posso ficar tranquilo por ter a certeza de que você não vai perder nenhum conteúdo.
                            </p>
                            <p>
                                Então, é isso aí, não ignora esse e-mail, tá? Espero de verdade poder contar com a sua ajuda.
                            </p>
                            <p>
                                A gente se fala novamente em breve.
                            </p>
                            <br />
                            <p>
                                Grande abraço,
                            </p>
                            <p>
                                Renato Pereira
                            </p>',
                'created_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'nome_template' => '2) GRUPO DE WHATSAPP',
                'assunto' => 'Tudo o que você precisa para acessar o evento',
                'descricao' => '<p>Fala Dev,</p>
                        <p>
                            Aqui é o Renato Pereira, eu vi que ontem você se inscreveu para participar do <strong>Programador 10x</strong> e que a sua inscrição já foi confirmada! 
                        </p>
                        <p>                            
                            Pensando em tornar sua experiência  ainda melhor, nós criamos um grupo exclusivo no Whatsapp para quem se inscreveu no evento.
                        </p>
                        <p>                            
                            Nesse grupo, você vai receber todos os links de acesso e conteúdos extras do Programador 10x.
                        </p>
                        <p>                            
                            Lá no grupo de WhatsApp, a entrega dos conteúdos é imediata. Assim, você  não corre o  risco de alguma  mensagem não chegar ou cair no SPAM, como pode acontecer com o e-mail, às vezes.
                        </p>
                        <p>                            
                            Ah, e pode ficar despreocupado porque o grupo é altamente moderado e apenas administradores podem enviar mensagens. 
                        </p>
                        <p>                            
                            Eu te garanto que por lá você vai receber apenas mensagens oficiais do evento, tá?
                        </p>
                        <p>
                           Então pra não perder absolutamente nada desse evento, eu recomendo que você participe agora mesmo do grupo de whatsapp, é só clicar no link abaixo:
                        </p>
                        <p>
                            PARTICIPAR DO WHATSAPP (<a href="https://chat.whatsapp.com/BckDnYMVnXID7TzbLjXA9W">https://chat.whatsapp.com/BckDnYMVnXID7TzbLjXA9W</a>)
                        </p>
                        <br />
                        <p>
                            Abraço, 
                        </p>
                        <p>
                            Renato Pereira
                        </p>',
                'created_at' => date('Y-m-d H:i:s')
            ]
        ];

        TemplateEmail::insert($templates);
    }
}
