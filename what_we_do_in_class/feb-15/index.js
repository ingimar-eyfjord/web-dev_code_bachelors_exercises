// const array = ["a", "s", "d", "k", "x"];
// for (let i = 0; i < array.length; i++) {
//   if (array[i] == "x") {
//     console.log("wow");
//   } else {
//     console.log(array[i]);
//   }
// }

const students = [
  ["a", "aa", 1],
  ["b", "bb", 2],
  ["c", "cc", 3],
];

let total = 0;
students.forEach((e) => {
  total = total + e[2];
  //   console.log(`last name ${e[1]}`);
});
console.log(total);

const users = { id: 1, name: "a" };
delete users.id;
console.log(users);

let people = [];
let person_one = { id: 1, name: "a" };
let person_two = { id: 2, name: "b" };
let person_three = { id: 3, name: "c" };
people.push(person_one, person_two, person_three);
// people[1].name = "x";
for (const p of people) {
  p.age = Math.floor(Math.random() * 150 + 1);
  p.created = 0;
}

let totalAge = 0;
for (const p of people) {
  totalAge += p.age;
}
const average = totalAge / people.length;
console.log(people);
console.log(average);

for (const p of people) {
  let name = p.name;
  //   if (name == "x") {
  //     name = "wow";
  //   }
  console.log(
    `User with id ${p.id} is called ${p.name == "x" ? "wow" : p.name}`
  );
}

localStorage.people = JSON.stringify(people);
const data = JSON.parse(localStorage.people);
console.log(data);
