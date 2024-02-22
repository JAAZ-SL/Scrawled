<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/level.css" />
  </head>
  <body>
    <?php

    $serverName = "localhost";
    $userName = "root";
    $passWord = "";
    $dbName = "scrawled";

    $conn = new mysqli($serverName, $userName, $passWord, $dbName);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
        header("Location: error.html");
    }
    
    $sql = "SELECT * FROM levels";
    $result = $conn->query($sql);
    
    $tope = $result->num_rows;
    $randomNum = rand(1, $tope);

    $sql = "SELECT * FROM levels WHERE id = " . $randomNum;
    $result = $conn->query($sql);

    $row = $result->fetch_assoc();

    $word = $row["word"];
    ?>
    <audio class="correct-audio">
      <source src="assets/correct-audio.mp3" type="audio/mpeg" />
    </audio>
    <main class="main-content">
      <div class="level-container">
        <img style="width: 50vw; height: 70vh;" src="<?php echo $row["path"] ?>" alt="">
      </div>
      <div class="input-container">
        <div class="wordDisplay" hidden></div>
        <input
          type="text"
          class="wordInput"
          placeholder="Type here..."
          oninput="resizeInput(this)"
          maxlength="40"
          autofocus
        />

      </div>
    </main>

    <script>
      function resizeInput(input) {
        input.style.width = "auto";
        input.style.width = input.scrollWidth + "px";
      }

      const wordDisplayElement = document.querySelector(".wordDisplay");
      const wordInputElement = document.querySelector(".wordInput");
      const correctAudio = document.querySelector(".correct-audio");

      async function getWord() {
        return "<?php echo $word ?>";

        return fetch(RANDOM_QUOTE_API_URL)
          .then(response => response.json())
          .then(data => data.content)
      }

      async function renderNewWord() {
        const word = await getWord();
        wordDisplayElement.innerHTML = "";
        word.split("").forEach((character) => {
          const characterSpan = document.createElement("span");
          characterSpan.innerText = character;
          wordDisplayElement.appendChild(characterSpan);
        });
        wordInputElement.value = null;
      }

      async function startGame() {
        await renderNewWord();
        wordInputElement.addEventListener("input", () => {
          const arrayWord = wordDisplayElement.querySelectorAll("span");
          const arrayValue = wordInputElement.value.split("");

          let correct = true;
          arrayWord.forEach((characterSpan, index) => {
            const character = arrayValue[index];
            if (character == null) {
              characterSpan.classList.remove("correct");
              characterSpan.classList.remove("incorrect");
              correct = false;
            } else if (character === characterSpan.innerText) {
              characterSpan.classList.add("correct");
              characterSpan.classList.remove("incorrect");
            } else {
              characterSpan.classList.remove("correct");
              characterSpan.classList.add("incorrect");
              correct = false;
            }
          });

          if (correct) {
            correctAudio.play();
            renderNewWord();
            setTimeout(function() {
                location.reload();
            }, 1000);
        }

                });
              }

      startGame();
    </script>
  </body>
</html>
