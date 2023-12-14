export const timer = (value) => {
  let count = value;
  const intervalId = setInterval(() => {
    if (count >= 0) {
      console.log(count);
      count--;
    } else {
      clearInterval(intervalId);
      console.log("Timer finished");
    }
  }, 1000);
};
