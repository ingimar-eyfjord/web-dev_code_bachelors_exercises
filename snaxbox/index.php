<?php
require "header.php";
?>
<p class="hello">Hello World</p>
Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet, a unde tenetur autem vitae labore nulla ea quis officiis
totam.
<script>
window.addEventListener("DOMContentLoaded", async e => {


    const mostPopular = JSON.parse(await getMostPopular())
    const orders = JSON.parse(await getOrdersNyDate())
    console.log(mostPopular, orders)
    const DateLabels = []
    const orders_quantity = []
    orders.forEach(e => {
        DateLabels.push(e.date_ordered)
        orders_quantity.push(e.order_quantity)
    })

    async function getMostPopular() {
        return Promise.resolve($.ajax({
            type: "GET",
            url: `services/most_popular_by_country.php`
        }));

    }
    async function getOrdersNyDate() {
        return Promise.resolve($.ajax({
            type: "GET",
            url: `services/orders_per_day.php`
        }));
    }
    const ctx = document.getElementById('myChart').getContext('2d');
    const element = document.getElementById('myChart')

    const parent = element.parentNode
    element.width = parent.offsetWidth;
    element.height = parent.offsetHeight;



    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: DateLabels,
            datasets: [{
                label: 'Orders',
                backgroundColor: 'transparent',
                borderColor: 'rgb(255, 99, 132)',
                data: orders_quantity
            }]
        },
        // Configuration options go here
        options: {}
    });

    const thead = document.querySelector('.MPHead')
    const td = document.querySelector('.MPtb')
    const thr = document.createElement('tr')
    Object.keys(mostPopular[0]).forEach(s => {
        const th = document.createElement('th')
        th.textContent = s
        thr.appendChild(th)
        thead.appendChild(thr)
    })
    mostPopular.forEach(e => {
        const row = document.createElement('tr')
        Object.values(e).forEach(es => {
            const td = document.createElement('td')
            td.textContent = es
            row.appendChild(td)
        })
        td.appendChild(row)
    })


})
</script>

<table class="MostPopular">
    <thead class="MPHead">
    </thead>
    <tbody class="MPtb">
    </tbody>
</table>
<div class="lineGraph">
    <canvas id="myChart" width="100%" height="100%"></canvas>
</div>