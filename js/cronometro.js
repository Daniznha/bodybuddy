let startTime = 0;
let elapsedTime = 0;
let running = false;
let interval;
const timerElement = document.getElementById("timer");
const startStopButton = document.getElementById("startStop");
const resetButton = document.getElementById("reset");
const saveButton = document.getElementById("save");
const clearButton = document.getElementById("clear"); 
const savedTimesList = document.getElementById("savedTimes");

// formato do tempo 
function formatTime(milliseconds) {
    const date = new Date(milliseconds);
    return date.toISOString().substr(11, 8) + '.' + date.getUTCMilliseconds();
}

function updateTimer() {
    const currentTime = Date.now() - startTime;
    timerElement.textContent = formatTime(currentTime);
}
// iniciar tempo
function startTimer() {
    if (!running) {
        startTime = Date.now() - elapsedTime;
        running = true;
        startStopButton.textContent = "Parar";
        interval = setInterval(updateTimer, 10);
    } else {
        clearInterval(interval);
        running = false;
        startStopButton.textContent = "Continuar";
        elapsedTime = Date.now() - startTime;
    }
}
// função para resetar o tempo
function resetTimer() {
    clearInterval(interval);
    running = false;
    startStopButton.textContent = "Iniciar";
    startTime = 0;
    elapsedTime = 0;
    timerElement.textContent = "00:00:00.000";
}
// função para salvar os tempos
function saveTime() {
    const currentTime = running ? Date.now() - startTime : elapsedTime;
    const savedTime = formatTime(currentTime);
    const listItem = document.createElement("li");
    listItem.textContent = savedTime;
    savedTimesList.appendChild(listItem);
}

// função para limpar os tempos salvos
function clearSavedTimes() {
    while (savedTimesList.firstChild) {
        savedTimesList.removeChild(savedTimesList.firstChild);
    }
}

startStopButton.addEventListener("click", startTimer);
resetButton.addEventListener("click", resetTimer);
saveButton.addEventListener("click", saveTime);
clearButton.addEventListener("click", clearSavedTimes); // adicionar evento de clique ao novo botão





