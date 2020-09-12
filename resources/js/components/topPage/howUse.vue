<template>
  <div class="howUse">
    <div class="title">
        <h1>HOW TO USE</h1>
        <p>簡単3つのステップ</p>
    </div>
    <v-row 
    justify="center"
    >
        <v-col md="3" cols="12" class="howUse-text">
            <!-- <img src="../../../../storage/app/public/order.jpg" alt=""> -->
            <h6>料理を注文</h6>
            <p>
                専用アプリまたはWEBから料理を注文します
            </p>
        </v-col>

        <v-col md="3" cols="12" class="howUse-text">
            <!-- <img src="../../../../storage/app/public/receive.jpg" alt=""> -->
            <h6>受け取りに行く</h6>
            <p>
                受け取り時刻になったら <br> 
                お店に料理を受け取りに行きます
            </p>
        </v-col>

        <v-col md="3" cols="12" class="howUse-text">
            <!-- <img src="../../../../storage/app/public/eat.jpg" alt=""> -->
            <h6>いただきます</h6>
            <p>
                料理を受け取れたら <br>
                好きな場所で召し上がれます
            </p>
        </v-col>
    </v-row>
  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.howUse{
    margin: 60px 0;
}

.title{
    text-align: center;
}

.title p{
    font-size:14px;
    color:gray;
}

.howUse-text{
    text-align: center;
    padding: 12px 40px;
}

.howUse-text h6{
    margin-top: 5px;
    font-weight: bold;
}

.howUse-text p{
    margin: 10px 0;
}



img{
    width:100%;
    height:210px;
    border-radius:50%;
}
</style>