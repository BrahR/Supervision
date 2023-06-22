<script setup lang="ts">
import InputError from "@/components/InputError.vue";

import { ref } from "vue";
import { useRouter } from "vue-router";
import ToastNotification from "@/components/ToastNotification.vue";
import { TYPE, useToast } from "vue-toastification";
import axios from "axios";

const toast = useToast()

const email = ref("");
const password = ref("");

const router = useRouter();
const onSubmit = async () => {
  let status = "";
  let message = "";
  const payload = {
    email: email.value,
    password: password.value,
  };

  if (email.value === "") {
    toast(
      {
        component: ToastNotification,
        props: {
          status: "Error",
          message: "Email is required",
        }
      },
      {
        type: TYPE.ERROR
      }
    )
    return;
  }

  if (password.value === "") {
    toast(
      {
        component: ToastNotification,
        props: {
          status: "Error",
          message: "Password is required",
        }
      },
      {
        type: TYPE.ERROR
      }
    )
    return;
  }

  try {
    const movedResponse = await axios.post(
      '//localhost:80/supervision/api/global/login.php',
      payload
    )
    status = movedResponse.data.status
    message = movedResponse.data.message
  } catch (err) {
    status = err.response.data.status
    message = err.response.data.message
  }

  if (status === "Error") {
    toast(
      {
        component: ToastNotification,
        props: {
          status: status,
          message: message,
        }
      },
      {
        type: TYPE.ERROR
      }
    )
    return;
  }

  toast(
    {
      component: ToastNotification,
      props: {
        status: status,
        message: message,
      }
    },
    {
      type: TYPE.SUCCESS
    }
  )

  setTimeout(() => {
    router.push("Home");
  }, 2000);
};

</script>

<template>
  <head>
    <title> Login admin</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet" />
    <meta name="viewport" content="" />
  </head>

  <body>
    <div class="container">
      <div class="img">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 500 500" style="enable-background:new 0 0 500 500;" xml:space="preserve">
          <g id="BACKGROUND">
          <rect x="-0.08" y="0" class="stt0" width="500" height="500"/>
                      <path id="SVGID_x5F_1_x5F_" class="stt1" d="M103.21,418.56c4.66,8.6,21.32,14.5,39.47,14.22c16.53-0.25,31.24-5.58,36.29-13.26"/>
                      <text>	<textPath  xlink:href="#SVGID_x5F_1_x5F_" startOffset="17.3155%">
          </textPath>
        </text>
        </g>
          <g id="OBJECTS">
          <g>
            <g>
              <g>
              </g>
            </g>
            <g>
              <g>
                <path class="stt2" d="M395.48,245.24h-10.34l-5.17-8.95l5.17-8.95h10.34l5.17,8.95L395.48,245.24z"/>
                <path class="stt3" d="M382.6,238.79v-5h-39l5.91-6.07c4.43-4.54,4.33-11.84-0.22-16.24l-19.64-19.11
                  c-4.53-4.44-11.81-4.34-16.24,0.22l-5.94,6.11c-1.9,1.95-4.3,3.19-6.83,3.65v-7.21l12.32-12.32V159.2l5.68-3.28v-10.34
                  l-8.95-5.17l-8.95,5.17v10.34l7.22,4.17v20.66l-12.32,12.32v9.2c-0.92-0.2-1.83-0.5-2.71-0.91c-3.18-1.49-6.47-2.83-9.82-4.01
                  v-25.4l12.32-12.32v-23.04l6.69-3.86v-10.34l-8.95-5.17l-8.95,5.17v10.34l6.22,3.59v21.24l-12.32,12.32v25.17
                  c-3.21-2.31-5.23-6.05-5.29-10.16l-0.12-8.51c-0.09-6.35-5.28-11.43-11.65-11.34l-14.48,0.19v61.95h-0.19v46.16l-6.45,3.72
                  v10.34l8.95,5.17l8.95-5.17v-10.34l-6.45-3.72v-40.9c0.65,0.02,1.29,0.03,1.94,0.07c2.79,0.18,5.54,0.55,8.22,1.1v16.73
                  l-6.45,3.72v10.34l8.95,5.17l8.95-5.17v-10.34l-6.45-3.72v-15.49c4.03,1.18,7.9,2.77,11.56,4.7v48.81l-7.24,4.18v10.34
                  l8.95,5.17l8.95-5.17v-10.34l-5.67-3.27v-46.76c15.5,10.15,26.34,27.01,28.12,46.35c0.61,6.63,0.16,13.07-1.17,19.19h68.72
                  c0.04-0.44,0.07-0.89,0.07-1.34l-0.38-27.4c-0.08-6.35-5.3-11.43-11.65-11.34l-8.52,0.11c-5.42,0.08-10.31-3.28-12.14-8.38
                  c-0.33-0.92-0.68-1.84-1.04-2.75h15.67v-5h-17.81c-0.54-1.19-1.1-2.37-1.69-3.54c-1.54-3.05-1.73-6.51-0.72-9.63H382.6z
                   M304.72,153.6v-5.72l4.95-2.86l4.95,2.86v5.72l-4.95,2.86L304.72,153.6z M288.2,130.42v-5.72l4.95-2.86l4.95,2.86v5.72
                  l-4.95,2.86L288.2,130.42z M253.83,279.37v5.72l-4.95,2.86l-4.95-2.86v-5.72l4.95-2.86L253.83,279.37z M268.99,256.37v5.72
                  l-4.95,2.86l-4.95-2.86v-5.72l4.95-2.86L268.99,256.37z M284.77,294.85v5.72l-4.95,2.86l-4.95-2.86v-5.72l4.95-2.86
                  L284.77,294.85z"/>
                <path class="stt4" d="M373.67,263.41h-10.34l-5.17-8.95l5.17-8.95h10.34l5.17,8.95L373.67,263.41z"/>
              </g>
              <g>
                <g>
                  <path class="stt4" d="M236.72,122.22c-48.88,1.3-93.17,20.92-126.25,52.28l33.55,33.54c24.5-22.8,56.91-37.13,92.7-38.48V122.22
                    z"/>
                  <path class="stt4" d="M236.72,179.86c-32.97,1.32-62.78,14.5-85.42,35.46l32.36,32.36c14.3-12.71,32.73-20.81,53.06-22.05
                    V179.86z"/>
                  <path class="stt4" d="M236.72,260.06v-24.13c-17.5,1.2-33.38,8.18-45.78,19.05l18.88,18.88
                    C216.87,266.6,226.23,261.61,236.72,260.06z"/>
                </g>
                <g>
                  <path class="stt5" d="M138.32,213.57c-23.48,24.77-38.17,57.9-39.14,94.48h35.43c1-26.78,11.72-51.02,28.79-69.38L138.32,213.57
                    z"/>
                  <path class="stt2" d="M168.86,244.12c-15.68,16.94-25.55,39.26-26.54,63.92h34.25c0.93-15.21,6.99-29.01,16.51-39.71
                    L168.86,244.12z"/>
                  <path class="stt5" d="M204.32,279.58l-5.8-5.79c-8.14,9.29-13.35,21.16-14.25,34.26h10.02
                    C195.75,297.82,199.21,288.18,204.32,279.58z"/>
                </g>
              </g>
            </g>
          </g>
          <text transform="matrix(1.2677 0 0 1 137.8062 342.4062)" class="stt3 stt6 stt7">InfoWatchdog</text>
          </g>
        </svg>
      </div>
      <div class="login-content">
        <form @submit.prevent="onSubmit">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               viewBox="0 0 3860.32 3268.78" style="enable-background:new 0 0 3860.32 3268.78;" xml:space="preserve">
            <g>
              <path class="st0" d="M2594.2,2152.19c0,224-329,329.04-734.85,329.04s-734.85-118.51-734.85-329.04
                c0-405.85,329-734.85,734.85-734.85S2594.2,1746.34,2594.2,2152.19z"/>
                            <path class="st1" d="M2594.2,2152.19c0,224-329,329.04-734.85,329.04c-302.12,0-561.66-65.67-674.59-186.09
                c132.19,53.48,312.1,81.76,510.36,81.76c405.85,0,734.85-105.03,734.85-329.03c0-226.05-102.06-428.25-262.62-563.06
                C2419.35,1601.3,2594.2,1856.33,2594.2,2152.19z"/>
                            <circle class="st0" cx="1859.35" cy="1134.13" r="496.48"/>
                            <path class="st1" d="M2355.84,1134.13c0,274.2-222.29,496.49-496.49,496.49c-235.29,0-432.37-163.68-483.55-383.4
                c74.89,152.9,232.04,258.19,413.78,258.19c254.33,0,460.5-206.17,460.5-460.49c0-141.71-64.01-268.47-164.7-352.95
                C2245.95,774.21,2355.84,941.34,2355.84,1134.13z"/>
                            <path class="st2" d="M1676.22,960.85c-80.84,80.83-136.24,156.5-188.87,103.88c-52.63-52.63-29.76-160.83,51.08-241.67
                c80.84-80.83,189.03-103.71,241.66-51.08C1832.72,824.6,1757.06,880.01,1676.22,960.85z"/>
                            <path class="st2" d="M1523.14,1836.64c-80.84,80.83-136.24,156.5-188.87,103.88c-52.63-52.63-29.76-160.83,51.08-241.67
                c80.84-80.83,189.03-103.71,241.66-51.08C1679.65,1700.4,1603.98,1755.8,1523.14,1836.64z"/>
            </g>
          </svg>
          <h2 class="title">Welcome</h2>
          <div class="input-div one">
            <div class="i">
              <i class="fas fa-user"></i>
            </div>
            <div class="div">
              <h5>Email</h5>
              <input
                type="text"
                class="input"
                name="email"
                v-model="email"
              />
              <InputError :message="Error" />
            </div>
          </div>

          <div class="input-div pass">
            <div class="i">
              <i class="fas fa-lock"></i>
            </div>
            <div class="div">
              <h5>Password</h5>
              <input
                type="password"
                class="input"
                name="password"
                v-model="password"
              />
              <InputError :message="Error" />
            </div>
          </div>

          <input type="submit" class="btn" value="Login" name="login" />
        </form>
      </div>
    </div>
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
  </body>
</template>

<style scoped>
.st0{fill:#4361AD;}
.st1{fill:#3156A7;}
.st2{fill:#6989C6;}

.stt0{opacity:0.5;fill:#EAF4F9;}
.stt1{fill:none;}
.stt2{fill:#FF8E27;}
.stt3{fill:#101C42;}
.stt4{fill:#00BBDD;}
.stt5{fill:#F5A530;}
.stt6{font-family:'HoboStd';}
.stt7{font-size:25.8561px;}

*{
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body{
  font-family: 'Poppins', sans-serif;
  overflow: hidden;
}

.wave{
  position: fixed;
  bottom: 0;
  left: 0;
  height: 100%;
  z-index: -1;
}

.container{
  width: 100vw;
  height: 100vh;
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  grid-gap :7rem;
  padding: 0 2rem;
}

.img{
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.login-content{
  display: flex;
  justify-content: flex-start;
  align-items: center;
  text-align: center;
}

.img img{
  width: 500px;
}

form{
  width: 360px;
}

.login-content img{
  height: 100px;
}

.login-content h2{
  margin: 15px 0;
  color: #333;
  text-transform: uppercase;
  font-size: 2.9rem;
}

.login-content .input-div{
  position: relative;
  display: grid;
  grid-template-columns: 7% 93%;
  margin: 25px 0;
  padding: 5px 0;
  border-bottom: 2px solid #d9d9d9;
}

.login-content .input-div.one{
  margin-top: 0;
}

.i{
  color: #d9d9d9;
  display: flex;
  justify-content: center;
  align-items: center;
}

.i i{
  transition: .3s;
}

.input-div > div{
  position: relative;
  height: 45px;
}

.input-div > div > h5{
  position: absolute;
  left: 10px;
  top: 50%;
  transform: translateY(-50%);
  color: #999;
  font-size: 18px;
  transition: .3s;
}

.input-div:before, .input-div:after{
  content: '';
  position: absolute;
  bottom: -2px;
  width: 0%;
  height: 2px;
  background-color: #38d39f;
  transition: .4s;
}

.input-div:before{
  right: 50%;
}

.input-div:after{
  left: 50%;
}

.input-div.focus:before, .input-div.focus:after{
  width: 50%;
}

.input-div.focus > div > h5{
  top: -5px;
  font-size: 15px;
}

.input-div.focus > .i > i{
  color: #38d39f;
}

.input-div > div > input{
  position: absolute;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  border: none;
  outline: none;
  background: none;
  padding: 0.5rem 0.7rem;
  font-size: 1.2rem;
  color: #555;
  font-family: 'poppins', sans-serif;
}

.input-div.pass{
  margin-bottom: 4px;
}

a{
  display: block;
  text-align: right;
  text-decoration: none;
  color: #999;
  font-size: 0.9rem;
  transition: .3s;
}

a:hover{
  color: #38d39f;
}

.btn{
  display: block;
  width: 100%;
  height: 50px;
  border-radius: 25px;
  outline: none;
  border: none;
  background-image: linear-gradient(to right, #32be8f, #38d39f, #32be8f);
  background-size: 200%;
  font-size: 1.2rem;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  text-transform: uppercase;
  margin: 1rem 0;
  cursor: pointer;
  transition: .5s;
}
.btn:hover{
  background-position: right;
}


@media screen and (max-width: 1050px){
  .container{
    grid-gap: 5rem;
  }
}

@media screen and (max-width: 1000px){
  form{
    width: 290px;
  }

  .login-content h2{
    font-size: 2.4rem;
    margin: 8px 0;
  }

  .img img{
    width: 400px;
  }
}

@media screen and (max-width: 900px){
  .container{
    grid-template-columns: 1fr;
  }

  .img{
    display: none;
  }

  .wave{
    display: none;
  }

  .login-content{
    justify-content: center;
  }
}
</style>