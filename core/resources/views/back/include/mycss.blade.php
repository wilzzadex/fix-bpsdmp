<style>
    td.details-control {
        background: url('{{ asset("back/icon/Plus.ico") }}') no-repeat center center;
        cursor: pointer;
    }
    tr.shown td.details-control {
        background: url('{{ asset("back/icon/Minus.ico") }}') no-repeat center center;
    }

    .card {
        /* Add shadows to create the "card" effect */
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        }

        /* On mouse-over, add a deeper shadow */
        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Add some padding inside the card container */
        .container {
        padding: 2px 16px;
        }

    .card-title{
        font-size : 20px;
        font-weight : bold;
    }

    .recommendation, .recommendation ul {
        color: #999999;
        text-align: left;
        float: left;
        font-style: italic;
    }

   
</style>