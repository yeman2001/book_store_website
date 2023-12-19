<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .big-container {
        margin: 10px;
    }

    .header-title {
        display: flex;
        justify-content: space-between;
    }

    .header-title p {
        margin-top: auto;
        margin-bottom: auto;
    }

    .container-column {
        max-width: 100%;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, 25rem);
        align-items: flex-start;
        gap: 1rem;
        justify-content: center;
    }

    .column {
        display: flex;
        /* flex: 1; */
        /* margin: 10px;
        padding: 10px; */
        background-color: #eee;
    }

    .column-l img {
        width: 100px;

    }

    .column-r {
        padding: 5px;

    }

    @media (max-width: 767px) {
        .column {
            flex: 100%;
            margin: 0rem 2rem 0rem 2rem;
        }
    }
</style>

<body>
    <div class="big-container">
        <div class="header-title">
            <h1>addmintor</h1>
            <p>view all</p>
        </div>
        <div class="container-column">
            <div class="column">

                <div class="column-l">
                    <img src="./images/2928377168476.jpg" alt="">
                </div>
                <div class="column-r">
                    <h2>Column 1</h2>
                    <p>Lorem ipsum dolor sit amet,</p>
                    <p>10/-</p>
                </div>
            </div>
            <div class="column">
                <div class="column-l">
                    <img src="./images/2928377168476.jpg" alt="">
                </div>
                <div class="column-r">
                    <h2>Column 1</h2>
                    <p>Lorem ipsum dolor sit amet,</p>
                </div>
            </div>
            <div class="column">
                <div class="column-l">
                    <img src="./images/2928377168476.jpg" alt="">
                </div>
                <div class="column-r">
                    <h2>Column 1</h2>
                    <p>Lorem ipsum dolor sit amet,</p>
                </div>
            </div>
            <div class="column">
                <div class="column-l">
                    <img src="./images/2928377168476.jpg" alt="">
                </div>
                <div class="column-r">
                    <h2>Column 1</h2>
                    <p>Lorem ipsum dolor sit amet,</p>
                </div>
            </div>
        </div>
    </div>

</body>

</html>