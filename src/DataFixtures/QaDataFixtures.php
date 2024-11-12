<?php

namespace App\DataFixtures;

use App\Entity\QaData;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface; // Importa a interface
use Doctrine\Persistence\ObjectManager;

class QaDataFixtures extends Fixture implements FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        // Array de 50 perguntas e respostas pré-definidas para avaliação de saúde mental e física
        $qaItems = [
            [
                'question' => 'Com que frequência você tem se sentido deprimido(a) nas últimas duas semanas?',
                'answer' => 'Essa pergunta é baseada no PHQ-9, uma ferramenta de triagem para depressão.'
            ],
            [
                'question' => 'Você tem tido dificuldade para dormir ou dormido em excesso recentemente?',
                'answer' => 'Distúrbios do sono podem estar relacionados a condições de saúde mental como ansiedade e depressão.'
            ],
            [
                'question' => 'Com que frequência você se sente ansioso(a) ou nervoso(a)?',
                'answer' => 'Baseado no GAD-7, uma escala de avaliação da ansiedade generalizada.'
            ],
            [
                'question' => 'Você tem experimentado dores físicas sem uma causa aparente?',
                'answer' => 'Sintomas somáticos podem estar associados a transtornos de saúde mental.'
            ],
            [
                'question' => 'Como você avaliaria sua energia e vitalidade nos últimos meses?',
                'answer' => 'Baixa energia pode ser um indicativo de várias condições de saúde física e mental.'
            ],
            [
                'question' => 'Você tem mantido uma alimentação balanceada e regular?',
                'answer' => 'Há uma forte ligação entre hábitos alimentares e saúde mental e física.'
            ],
            [
                'question' => 'Com que frequência você pratica atividades físicas?',
                'answer' => 'A prática regular de exercícios está associada à melhora da saúde mental e física.'
            ],
            [
                'question' => 'Você sente que tem um bom suporte social de amigos e familiares?',
                'answer' => 'O suporte social é crucial para o bem-estar mental e pode influenciar a saúde física.'
            ],
            [
                'question' => 'Você tem experimentado mudanças significativas no seu peso sem intenção?',
                'answer' => 'Alterações no peso podem ser sinais de problemas de saúde física ou mental.'
            ],
            [
                'question' => 'Como você avalia seu nível de estresse atualmente?',
                'answer' => 'Níveis elevados de estresse podem impactar negativamente a saúde mental e física.'
            ],
            [
                'question' => 'Você tem se sentido sobrecarregado(a) com suas responsabilidades diárias?',
                'answer' => 'Sentir-se sobrecarregado pode ser um sinal de estresse crônico ou burnout.'
            ],
            [
                'question' => 'Com que frequência você se sente satisfeito(a) com suas realizações pessoais?',
                'answer' => 'A satisfação pessoal está ligada ao bem-estar emocional e autoestima.'
            ],
            [
                'question' => 'Você tem dificuldade em se concentrar ou tomar decisões?',
                'answer' => 'Problemas de concentração podem estar relacionados a ansiedade, depressão ou outras condições.'
            ],
            [
                'question' => 'Como você descreveria seu humor na maior parte do tempo?',
                'answer' => 'O humor persistente pode indicar estados emocionais estáveis ou transtornos de humor.'
            ],
            [
                'question' => 'Você tem sentido falta de interesse ou prazer em atividades que antes gostava?',
                'answer' => 'Perda de interesse pode ser um sintoma de depressão ou outros transtornos.'
            ],
            [
                'question' => 'Você tem pensamentos de se machucar ou de que a vida não vale a pena?',
                'answer' => 'Pensamentos suicidas são sinais de emergência e devem ser tratados com urgência profissional.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de lidar com desafios recentes?',
                'answer' => 'A resiliência é fundamental para enfrentar adversidades e manter a saúde mental.'
            ],
            [
                'question' => 'Você tem experimentado dores de cabeça frequentes?',
                'answer' => 'Dores de cabeça podem ser sintomas de estresse, ansiedade ou problemas físicos.'
            ],
            [
                'question' => 'Você tem dificuldades para relaxar ou se desligar das preocupações?',
                'answer' => 'A incapacidade de relaxar pode contribuir para níveis elevados de estresse e ansiedade.'
            ],
            [
                'question' => 'Como você descreveria sua qualidade de sono nas últimas semanas?',
                'answer' => 'Uma boa qualidade de sono é essencial para a saúde mental e física.'
            ],
            [
                'question' => 'Você tem sentido dores musculares ou tensões frequentemente?',
                'answer' => 'Tensões musculares podem ser resultado de estresse ou má postura.'
            ],
            [
                'question' => 'Com que frequência você se sente energizado(a) para realizar suas atividades diárias?',
                'answer' => 'Níveis adequados de energia são indicativos de boa saúde física e mental.'
            ],
            [
                'question' => 'Você tem se sentido isolado(a) ou sozinho(a) ultimamente?',
                'answer' => 'O isolamento social pode afetar negativamente a saúde mental.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de manter relacionamentos saudáveis?',
                'answer' => 'Relacionamentos saudáveis são importantes para o suporte emocional e bem-estar.'
            ],
            [
                'question' => 'Você tem sentido fadiga constante, mesmo após descanso adequado?',
                'answer' => 'A fadiga persistente pode ser um sinal de condições médicas ou mentais subjacentes.'
            ],
            [
                'question' => 'Você tem notado alguma alteração na sua memória recentemente?',
                'answer' => 'Problemas de memória podem estar relacionados ao estresse, ansiedade ou condições neurológicas.'
            ],
            [
                'question' => 'Como você lida com situações de conflito ou estresse?',
                'answer' => 'Estratégias eficazes de enfrentamento são essenciais para a saúde mental.'
            ],
            [
                'question' => 'Você tem tido dificuldades financeiras que impactam seu bem-estar?',
                'answer' => 'Problemas financeiros podem aumentar o estresse e afetar a saúde mental.'
            ],
            [
                'question' => 'Você tem praticado hobbies ou atividades que lhe trazem alegria?',
                'answer' => 'Engajar-se em atividades prazerosas contribui para o equilíbrio emocional.'
            ],
            [
                'question' => 'Como você descreveria seu equilíbrio entre vida pessoal e profissional?',
                'answer' => 'Um bom equilíbrio é crucial para evitar o burnout e manter a saúde mental.'
            ],
            [
                'question' => 'Você tem sentido que suas emoções estão fora de controle?',
                'answer' => 'Dificuldades emocionais podem ser indicativas de transtornos de humor ou ansiedade.'
            ],
            [
                'question' => 'Você tem tido sintomas de alergias ou asma recentemente?',
                'answer' => 'Condições físicas como alergias podem impactar o bem-estar geral.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de comunicar suas necessidades e sentimentos?',
                'answer' => 'A comunicação eficaz é fundamental para relacionamentos saudáveis e saúde mental.'
            ],
            [
                'question' => 'Você tem sentido dores no peito sem uma causa física aparente?',
                'answer' => 'Dores no peito podem estar associadas a ansiedade ou condições cardíacas.'
            ],
            [
                'question' => 'Com que frequência você se envolve em atividades sociais?',
                'answer' => 'Participar de atividades sociais pode melhorar o humor e reduzir o estresse.'
            ],
            [
                'question' => 'Você tem experimentado náuseas ou problemas digestivos sem motivo claro?',
                'answer' => 'Problemas digestivos podem estar ligados ao estresse e à ansiedade.'
            ],
            [
                'question' => 'Como você avalia sua autoimagem e autoestima atualmente?',
                'answer' => 'Uma boa autoestima é essencial para o bem-estar emocional.'
            ],
            [
                'question' => 'Você tem sentido dores nas articulações ou no corpo com frequência?',
                'answer' => 'Dores articulares podem ser sinais de condições físicas ou reações ao estresse.'
            ],
            [
                'question' => 'Com que frequência você se sente motivado(a) para alcançar seus objetivos?',
                'answer' => 'A motivação está ligada ao engajamento e à satisfação pessoal.'
            ],
            [
                'question' => 'Você tem experimentado palpitações ou batimentos cardíacos acelerados?',
                'answer' => 'Palpitações podem ser sintomas de ansiedade ou condições médicas.'
            ],
            [
                'question' => 'Como você lida com a incerteza e mudanças inesperadas?',
                'answer' => 'A adaptabilidade é importante para manter a saúde mental diante de mudanças.'
            ],
            [
                'question' => 'Você tem notado uma diminuição na sua capacidade de realizar tarefas físicas?',
                'answer' => 'Diminuição da capacidade física pode indicar problemas de saúde ou fadiga.'
            ],
            [
                'question' => 'Com que frequência você se sente otimista sobre o futuro?',
                'answer' => 'Otimismo está relacionado a uma melhor saúde mental e resiliência.'
            ],
            [
                'question' => 'Você tem tido dificuldades para iniciar ou completar tarefas?',
                'answer' => 'Dificuldades em tarefas podem estar relacionadas a transtornos de atenção ou motivação.'
            ],
            [
                'question' => 'Como você descreveria sua relação com a alimentação emocional?',
                'answer' => 'A alimentação emocional pode impactar a saúde física e mental.'
            ],
            [
                'question' => 'Você tem sentido dores abdominais frequentes sem uma causa médica?',
                'answer' => 'Dores abdominais podem estar associadas ao estresse e à ansiedade.'
            ],
            [
                'question' => 'Com que frequência você se sente irritado(a) ou frustrado(a)?',
                'answer' => 'Irritabilidade pode ser um sintoma de estresse, ansiedade ou depressão.'
            ],
            [
                'question' => 'Você tem experimentado sensações de formigamento ou dormência?',
                'answer' => 'Sensações físicas como formigamento podem indicar condições neurológicas ou estresse.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de estabelecer e manter limites pessoais?',
                'answer' => 'Estabelecer limites saudáveis é crucial para a saúde mental e relacionamentos.'
            ],
            [
                'question' => 'Você tem sentido dores no estômago ou problemas digestivos com frequência?',
                'answer' => 'Problemas digestivos recorrentes podem estar ligados ao estresse ou à ansiedade.'
            ],
            [
                'question' => 'Com que frequência você se sente cansado(a) sem motivo aparente?',
                'answer' => 'Cansaço constante pode ser um sinal de fadiga, estresse ou condições médicas.'
            ],
            [
                'question' => 'Você tem tido dificuldades para manter a concentração durante o dia?',
                'answer' => 'Problemas de concentração podem estar relacionados a ansiedade, depressão ou falta de sono.'
            ],
            [
                'question' => 'Como você lida com sentimentos de culpa ou arrependimento?',
                'answer' => 'Gerenciar sentimentos negativos é importante para a saúde mental.'
            ],
            [
                'question' => 'Você tem sentido dores nas costas ou no pescoço frequentemente?',
                'answer' => 'Dores musculares podem ser resultado de má postura, estresse ou lesões.'
            ],
            [
                'question' => 'Com que frequência você se envolve em atividades de lazer?',
                'answer' => 'Participar de lazer contribui para o equilíbrio emocional e redução do estresse.'
            ],
            [
                'question' => 'Você tem sentido dificuldade para respirar em situações de estresse?',
                'answer' => 'Dificuldades respiratórias podem ser sintomas de ataques de pânico ou ansiedade.'
            ],
            [
                'question' => 'Como você avalia sua satisfação com sua vida atual?',
                'answer' => 'A satisfação com a vida está ligada ao bem-estar geral e felicidade.'
            ],
            [
                'question' => 'Você tem sentido dores no peito ou desconforto sem uma causa física?',
                'answer' => 'Dores no peito podem estar associadas a ansiedade ou condições cardíacas.'
            ],
            [
                'question' => 'Com que frequência você sente necessidade de isolar-se dos outros?',
                'answer' => 'A tendência ao isolamento pode indicar depressão ou outras questões de saúde mental.'
            ],
            [
                'question' => 'Você tem experimentado mudanças no apetite, seja aumento ou diminuição?',
                'answer' => 'Alterações no apetite podem ser sintomas de estresse, ansiedade ou depressão.'
            ],
            [
                'question' => 'Como você lida com sentimentos de raiva ou frustração?',
                'answer' => 'Gerenciar emoções como raiva é essencial para manter relacionamentos saudáveis e bem-estar mental.'
            ],
            [
                'question' => 'Você tem sentido dores de garganta frequentes sem uma causa aparente?',
                'answer' => 'Dores de garganta recorrentes podem estar ligadas ao estresse ou à ansiedade.'
            ],
            [
                'question' => 'Com que frequência você sente que não tem controle sobre sua vida?',
                'answer' => 'Sentir falta de controle pode aumentar os níveis de estresse e ansiedade.'
            ],
            [
                'question' => 'Você tem tido dificuldades financeiras que afetam seu bem-estar mental?',
                'answer' => 'Problemas financeiros são uma fonte comum de estresse e podem impactar a saúde mental.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de buscar ajuda quando necessário?',
                'answer' => 'Buscar ajuda é crucial para lidar com desafios de saúde mental e física.'
            ],
            [
                'question' => 'Você tem sentido dores de cabeça tensionais ou enxaquecas frequentemente?',
                'answer' => 'Dores de cabeça podem ser causadas por estresse, tensão muscular ou condições neurológicas.'
            ],
            [
                'question' => 'Com que frequência você se sente sobrecarregado(a) com informações ou estímulos?',
                'answer' => 'Sentir-se sobrecarregado pode levar ao estresse e impactar a saúde mental.'
            ],
            [
                'question' => 'Você tem experimentado mudanças na sua libido ou interesse sexual?',
                'answer' => 'Mudanças na libido podem estar relacionadas a fatores físicos ou emocionais.'
            ],
            [
                'question' => 'Como você descreveria sua capacidade de lidar com frustrações?',
                'answer' => 'A habilidade de lidar com frustrações é essencial para a resiliência emocional.'
            ],
            [
                'question' => 'Você tem sentido dores no peito ou desconforto sem causa física?',
                'answer' => 'Dores no peito podem ser sintomas de ansiedade ou condições cardíacas.'
            ],
            [
                'question' => 'Com que frequência você se sente entediado(a) ou desinteressado(a) nas atividades diárias?',
                'answer' => 'O tédio pode estar ligado à depressão ou à falta de estímulo.'
            ],
            [
                'question' => 'Você tem sentido dificuldade para manter um peso saudável?',
                'answer' => 'Manter um peso saudável está relacionado a hábitos alimentares e saúde física e mental.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de gerenciar seu tempo de forma eficaz?',
                'answer' => 'Uma boa gestão do tempo pode reduzir o estresse e aumentar a produtividade.'
            ],
            [
                'question' => 'Você tem sentido dores de estômago ou digestivas sem uma causa aparente?',
                'answer' => 'Dores digestivas podem ser sintomas de estresse ou ansiedade.'
            ],
            [
                'question' => 'Com que frequência você sente que está no controle de suas emoções?',
                'answer' => 'Sentir-se no controle das emoções contribui para a estabilidade mental.'
            ],
            [
                'question' => 'Você tem experimentado tremores ou inquietação física sem motivo?',
                'answer' => 'Tremores podem ser sintomas de ansiedade ou condições médicas.'
            ],
            [
                'question' => 'Como você descreveria seu nível de motivação para suas atividades diárias?',
                'answer' => 'A motivação afeta a produtividade e o bem-estar emocional.'
            ],
            [
                'question' => 'Você tem sentido dores de coluna ou postura inadequada frequentemente?',
                'answer' => 'Dores na coluna podem ser causadas por má postura, estresse ou lesões.'
            ],
            [
                'question' => 'Com que frequência você pratica técnicas de relaxamento, como meditação ou respiração profunda?',
                'answer' => 'Práticas de relaxamento podem reduzir o estresse e melhorar a saúde mental.'
            ],
            [
                'question' => 'Você tem sentido dificuldade para expressar suas emoções?',
                'answer' => 'Expressar emoções é fundamental para a saúde mental e relacionamentos saudáveis.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de enfrentar desafios inesperados?',
                'answer' => 'A capacidade de enfrentar desafios está ligada à resiliência e ao bem-estar emocional.'
            ],
            [
                'question' => 'Você tem experimentado tonturas ou vertigens sem uma causa aparente?',
                'answer' => 'Tonturas podem ser sintomas de ansiedade ou problemas de saúde física.'
            ],
            [
                'question' => 'Com que frequência você se sente feliz ou satisfeito(a) com sua vida?',
                'answer' => 'Sentir-se feliz está diretamente relacionado ao bem-estar mental.'
            ],
            [
                'question' => 'Você tem sentido dores musculares ou tensões sem motivo claro?',
                'answer' => 'Tensões musculares podem ser resultado de estresse ou má postura.'
            ],
            [
                'question' => 'Como você descreveria sua capacidade de definir e alcançar metas pessoais?',
                'answer' => 'Definir e alcançar metas contribui para a autoestima e satisfação pessoal.'
            ],
            [
                'question' => 'Você tem sentido falta de ar ou dificuldades respiratórias frequentemente?',
                'answer' => 'Dificuldades respiratórias podem ser sintomas de ansiedade ou condições médicas.'
            ],
            [
                'question' => 'Com que frequência você se sente grato(a) pelas coisas que possui?',
                'answer' => 'Sentir gratidão está associado a níveis mais altos de bem-estar e felicidade.'
            ],
            [
                'question' => 'Você tem tido dificuldades para manter hábitos saudáveis, como alimentação e exercícios?',
                'answer' => 'Manter hábitos saudáveis é essencial para a saúde física e mental.'
            ],
            [
                'question' => 'Como você lida com a pressão em situações de alta demanda?',
                'answer' => 'Lidar eficazmente com a pressão é importante para evitar o estresse crônico.'
            ],
            [
                'question' => 'Você tem sentido dores de cabeça frequentes sem uma causa física?',
                'answer' => 'Dores de cabeça recorrentes podem ser causadas por estresse, tensão muscular ou condições neurológicas.'
            ],
            [
                'question' => 'Com que frequência você se sente confiante em suas habilidades pessoais?',
                'answer' => 'A autoconfiança está ligada à autoestima e ao bem-estar emocional.'
            ],
            [
                'question' => 'Você tem sentido dores no peito ou desconforto sem causa física?',
                'answer' => 'Dores no peito podem ser sintomas de ansiedade ou condições cardíacas.'
            ],
            [
                'question' => 'Como você avalia sua capacidade de manter um equilíbrio saudável entre trabalho e vida pessoal?',
                'answer' => 'Um bom equilíbrio entre trabalho e vida pessoal é crucial para a saúde mental e física.'
            ],
        ];

        foreach ($qaItems as $index => $item) {
            $qaData = new QaData();
            $qaData->setQuestion($item['question']);
            $qaData->setAnswer($item['answer']);

            $manager->persist($qaData);

            // Adicione uma referência para cada QaData criada
            $this->addReference('qa_' . $index, $qaData);
        }

        $manager->flush();
    }

    public static function getGroups(): array
    {
        return ['qa_data'];
    }
}
