// Array de frases aleatórias
const frases = [
    "A creatina é armazenada principalmente nos músculos esqueléticos, onde desempenha um papel fundamental na regeneração de ATP, a moeda de energia das células.",
    "Estudos sugerem que a creatina pode ser benéfica para pessoas de todas as idades, incluindo idosos, atletas e aqueles que buscam melhorar a função cerebral.",
    "Proteínas são os blocos de construção da vida, desempenhando papéis cruciais na construção e reparo de tecidos, enzimas e hormônios.",
    "Os alimentos de origem animal, como carne, ovos e laticínios, geralmente contêm proteínas completas, fornecendo todos os aminoácidos essenciais.",
    "As proteínas vegetais podem ser combinadas para formar uma proteína completa, mostrando a diversidade de fontes disponíveis para dietas vegetarianas e veganas.",
    "A ingestão adequada de proteínas está ligada ao aumento da saciedade, o que pode auxiliar no controle do peso.",
    "A proteína do soro do leite (whey) é uma fonte popular de proteína, sendo rapidamente absorvida e rica em aminoácidos de cadeia ramificada (BCAAs).",
    "A quantidade de proteína necessária pode variar de acordo com o peso, nível de atividade física e metas individuais, sendo crucial para o crescimento muscular e a recuperação.",
    "O ganho de massa muscular requer uma combinação eficaz de treinamento de resistência, nutrição adequada e descanso suficiente para permitir a recuperação.",
    "A variedade nos exercícios é crucial para promover um desenvolvimento muscular equilibrado, atingindo diferentes grupos musculares e evitando platôs de treinamento.",
    "O descanso é tão importante quanto o treino, pois é durante o repouso que os músculos se recuperam e crescem.",
    "Exercícios aeróbicos, como corrida e ciclismo, são essenciais para a saúde cardiovascular, enquanto o treinamento de resistência é crucial para o desenvolvimento muscular.",
    "A flexibilidade é uma parte muitas vezes negligenciada do condicionamento físico, mas é fundamental para a prevenção de lesões e para o desempenho ótimo.",
    "A prática regular de exercícios físicos pode melhorar a saúde mental, reduzindo o estresse e melhorando o humor através da liberação de endorfinas.",
    "O HIIT (Treinamento Intervalado de Alta Intensidade) é uma abordagem eficaz para queimar gordura e melhorar o condicionamento físico em um curto espaço de tempo.",
    "O treinamento de força não apenas constrói músculos, mas também fortalece ossos, tendões e ligamentos, contribuindo para uma estrutura corporal mais resistente.",
    "A consistência é mais importante do que a intensidade. Manter uma rotina de exercícios regulares ao longo do tempo traz benefícios duradouros.",
    "A atividade física não precisa ser formal, coisas simples como caminhar, jardinagem e dançar também contribuem para um estilo de vida ativo."
    
    
];

// Função para exibir uma frase aleatória
function exibirFraseAleatoria() {
    const fraseContainer = document.getElementById("frases");
    const randomIndex = Math.floor(Math.random() * frases.length);
    const randomFrase = frases[randomIndex];
    fraseContainer.textContent = randomFrase;
}

// Exibir uma frase aleatória inicial
exibirFraseAleatoria();

// Atualizar a frase a cada 15 segundos
setInterval(exibirFraseAleatoria, 15000);
