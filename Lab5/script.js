window.onload = ()=>{

    const tableCells = document.getElementsByClassName("photo");

    let first = "";
    let second = "";
    let count = 0;

    const check = function () {

        let result = "";
        document.querySelectorAll("img").forEach(element => result += element.id[0]);
        return result === "123456789";
    };

    const condition = function () {


        if (check()) {
            setTimeout(function () {
                alert("Congratulations!");
            }, 10);

        }

    };


    const swap = function () {
        //  console.log(event);
        if (!first) {
            first = this.getAttribute("id")[0];
            console.log(first);
        }
        count++;
        if (count > 1 && first) {
            second = this.getAttribute("id")[0];
            console.log(second);
        }


        if (first && second && first !== second) {
            let firstTd = document.getElementById(first);
            let secondTd = document.getElementById(second);
            let firstImage = firstTd.childNodes[0];
            let secondImage = secondTd.childNodes[0];

            firstTd.childNodes[0].remove();
            secondTd.childNodes[0].remove();

            firstTd.append(secondImage);
            secondTd.append(firstImage);

            count = 0;
            first = "";
            second = "";
            condition();

        }
    };


    for (let i=0;i<tableCells.length;i++)
    {
        tableCells[i].addEventListener('click', swap,false);

    }



}