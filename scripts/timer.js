const timer = (difficulty) => {
  let count = 25;
  const timerElement = document.getElementById("timer");

  switch (difficulty) {
    case 2:
      count = 15;
      break;
    case 3:
      count = 8;
      break;
  }

  const intervalId = setInterval(() => {
    if (count >= 0) {
      timerElement.innerHTML = count;
      count--;
    } else {
      clearInterval(intervalId);
      timerElement.innerHTML = "Time's up!";
    }
  }, 1000);
};

const startButton = document.getElementById("startTimer");

startButton.addEventListener("click", () => {
  timer(2);
});
