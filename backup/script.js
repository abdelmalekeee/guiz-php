// Dit zijn de vragen voor de quiz
const questions = [
 
    {
      question: "Wat is de hoofdstad van Nederland?",
      options: ["Amsterdam", "Rotterdam", "Den Haag", "Utrecht"],
      correctAnswer: "Amsterdam",
    },
    {
      question: "Welke kleur krijg je door blauw en geel te mengen?",
      options: ["Groen", "Paars", "Oranje", "Bruin"],
      correctAnswer: "Groen",
    },
    {
      question: "Hoeveel dagen heeft een schrikkeljaar?",
      options: ["365", "366", "364", "367"],
      correctAnswer: "366",
    },
    {
      question: "Wat is de hoofdstad van Nederland?",
      options: ["Amsterdam", "Rotterdam", "Den Haag", "Utrecht"],
      correctAnswer: "Amsterdam",
    },
    {
      question: "Welke kleur krijg je door blauw en geel te mengen?",
      options: ["Groen", "Paars", "Oranje", "Bruin"],
      correctAnswer: "Groen",
    },
    {
      question: "Hoeveel dagen heeft een schrikkeljaar?",
      options: ["365", "366", "364", "367"],
      correctAnswer: "366",
    },
  ];
   
  // Wacht tot de pagina geladen is
  document.addEventListener("DOMContentLoaded", (event) => {
    let currentQuestionIndex = 0; // Huidige vraag index
    let goedeAntwoorden = 0; // Aantal goede antwoorden
    let foutAntwoorden = 0; // Aantal foute antwoorden
   
    const questionElement = document.getElementById("question"); // Vraag element
    const optionsElement = document.getElementById("options"); // Opties element
    const nextButton = document.getElementById("next"); // Volgende knop
   
    // Laad een vraag
    function loadQuestion() {
      const currentQuestion = questions[currentQuestionIndex];
      questionElement.textContent = currentQuestion.question;
      optionsElement.innerHTML = "";
   
      currentQuestion.options.forEach((option) => {
        const optionElement = document.createElement("button");
        optionElement.textContent = option;
        optionElement.classList.add("option");
        optionElement.addEventListener("click", () =>
          selectOption(optionElement, currentQuestion.correctAnswer)
        );
        optionsElement.appendChild(optionElement);
      });
   
      nextButton.style.display = "none";
    }
   
    // Selecteer een optie
    function selectOption(selectedElement, correctAnswer) {
      const options = document.querySelectorAll(".option");
      options.forEach((option) => {
        option.removeEventListener("click", () =>
          selectOption(option, correctAnswer)
        );
        option.style.pointerEvents = "none";
      });
   
      if (selectedElement.textContent === correctAnswer) {
        selectedElement.classList.add("correct");
        goedeAntwoorden++; // Verhoog goede antwoorden
      } else {
        selectedElement.classList.add("incorrect");
        foutAntwoorden++; // Verhoog foute antwoorden
      }
   
      currentQuestionIndex++;
      if (currentQuestionIndex < questions.length) {
        loadQuestion();
      } else {
        alert(`Je hebt de quiz voltooid! Goede antwoorden: ${goedeAntwoorden}, Foute antwoorden: ${foutAntwoorden}`);
        // Hier kun je eventueel de quiz resetten of de gebruiker naar een andere pagina leiden
      }
    }
   
    // Klik op de volgende knop
    nextButton.addEventListener("click", () => {
      currentQuestionIndex++;
      if (currentQuestionIndex < questions.length) {
        loadQuestion();
      } else {
        alert("Je hebt de quiz voltooid!");
        // Hier kun je eventueel de quiz resetten of de gebruiker naar een andere pagina leiden
      }
    });

    
   
    loadQuestion(); // Start de quiz
  });