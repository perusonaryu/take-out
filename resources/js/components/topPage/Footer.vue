<template>
  <div class="footer">
      <v-row
      justify="center"
      align= "center"
      >
          <v-col md="2" class="text-center logo">
            <router-link to="/">
            <img src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg" alt="">
            </router-link>
            <p>
                <router-link to="/">利用規約</router-link>
                ・
                <router-link to="/">プライバシーポリシー</router-link>
            </p>
          </v-col>

          <v-col md="2" class="text-center">
            <p>
                <router-link to="/">お問い合わせ(飲食店)</router-link>
            </p>
            <p>
                <router-link to="/">お問い合わせ(ユーザー)</router-link>
            </p>
            <p>
                <router-link to="/">本登録(飲食店)</router-link>
            </p>
          </v-col>

          <v-col md="2" class="text-center">
            <p>
                <router-link to="/">飲食店の方へ</router-link>
            </p>
            <p>
                <router-link to="/">よくある質問</router-link>
            </p>
            <p>
                <router-link to="/">運営会社</router-link>
            </p>
          </v-col>

          <v-col md="2" class="text-center app-logo">
            <p>
                <a 
                href="https://apps.apple.com/jp/app/itunes-store/id915061235?mt=8" 
                style="display:inline-block;overflow:hidden;background:url(https://linkmaker.itunes.apple.com/ja-jp/badge-lrg.svg?releaseDate=2016-06-01&kind=iossoftware&bubble=ios_apps) no-repeat;width:135px;height:40px;"
                ></a>

                <a 
                href="https://play.google.com/store/#?pcampaignid=MKT-Other-global-all-co-prtnr-py-PartBadge-Mar2515-1"
                >
                    <img alt="Google Play で手に入れよう" 
                    src="https://play.google.com/intl/en_us/badges/images/generic/ja_badge_web_generic.png" 
                    width="155">
                </a>
            </p>
          </v-col>

          <v-col md="3" class="text-center app-logo">
            <p>
                <i class="fab fa-facebook-square fa-3x"></i>
                <i class="fab fa-twitter fa-3x"></i>
                <i class="fab fa-instagram fa-3x"></i>
            </p>
            <p class="text">
                © XXXXXXX INC. ALL RIGHTS RESERVED
            </p>
            <p class="text">
                TEL: 000-0000-0000
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

.footer{
    background-color:#3f3f3f;
    color:white;
    padding: 80px 20px 100px;
}

img{
    width:100%;
    height:80px;
    border-radius:20px;
}

a{
    text-decoration:none;
    color:white!important;
}

.logo a{
    font-size:10px;
}

.app-logo p a img{
    width:155px!important;
    height:60px;
}

.app-logo .text{
    font-size:9px;
    margin-bottom:5px;
}
</style>