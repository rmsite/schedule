<template>
  <v-app>
    <div class="container">
      <div class="card">
        <div class="card-header bg-custom">Criação de atividade esportiva</div>
        <div class="card-body">
          <form @submit.prevent="createRecord(record)">
            <div class="form-group">
              <label for="inputEvent">Evento</label>
              <input
                type="text"
                class="form-control"
                id="inputEvent"
                v-model="record.title"
              />
            </div>
            <div class="form-group">
              <label for="inputDescription">Descrição</label>
              <textarea
                class="form-control"
                id="inputDescription"
                rows="3"
                v-model="record.content"
              ></textarea>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label>De:</label>
                </div>
                <date-picker
                  v-model="record.startDate"
                  value-type="YYYY-MM-DD"
                  format="DD MMMM YYYY"
                  :lang="configDatePicker.lang"
                ></date-picker>
              </div>
              <div class="col-6">
                <v-radio-group v-model="record.recurrence" column>
                  <v-radio
                    label="Não se repete"
                    color="deep-purple darken-4"
                    value="0"
                    @click="record.weekInterval=1"
                  ></v-radio>
                  <v-radio
                    label="Repetir"
                    color="deep-purple darken-4"
                    value="1"
                  ></v-radio>
                </v-radio-group>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="row">
                  <div class="col-6">
                    <div class="form-group">
                      <label>Início:</label>
                    </div>
                    <date-picker
                      type="time"
                      v-model="record.startTime"
                      value-type="HH:mm"
                      format="HH:mm"
                      :lang="configDatePicker.lang"
                      :default-value="new Date().setHours(8, 0, 0, 0)"
                      :disabled-time="disableTime"
                      :hour-options="hours"
                      :time-picker-options="{
                        start: '08:00',
                        step: '00:60',
                        end: '19:00',
                      }"
                    ></date-picker>
                  </div>
                  <div class="col-6">
                    <div class="form-group">
                      <label>Término:</label>
                    </div>
                    <date-picker
                      type="time"
                      v-model="record.endTime"
                      value-type="HH:mm"
                      format="HH:mm"
                      :lang="configDatePicker.lang"
                      :default-value="new Date().setHours(8, 0, 0, 0)"
                      :disabled-time="disableTime"
                      :hour-options="hours"
                      :time-picker-options="{
                        start: '08:00',
                        step: '00:60',
                        end: '19:00',
                      }"
                    ></date-picker>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label>Intervalo de semanas:{{ record.weekInterval }}</label>
                </div>
                <v-slider
                  max="4"
                  min="1"
                  :disabled="record.recurrence == 0"
                  track-color="deep-purple darken-4"
                  color="deep-purple darken-4"
                  v-model="record.weekInterval"
                ></v-slider>
              </div>
            </div>
            <button type="submit" class="btn btn-primary bg-custom float-right">
              Salvar
            </button>
          </form>
        </div>
      </div>

      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <vue-cal
                :events="events"
                active-view="week"
                locale="pt-br"
                :time-from="7 * 60"
                :time-to="20 * 60"
                class="vuecal--green-theme"
                :disable-views="['years', 'year']"
                :time-cell-height="60"
                @view-change="changeView($event)"
                :special-hours="specialHours"
                :hide-weekdays="[7]"
                today-button
              >
              <template v-slot:today-button>
              <v-tooltip>
                <template v-slot:activator="{ on }">
                  <v-btn text v-on="on" @click="selectedDate = new Date()">
                    HOJE
                  </v-btn>
                </template>
              </v-tooltip>
              <button type="button" class="btn btn-light btn-sm" @click="selectedDate = new Date()">Hoje</button>
            </template>
            </vue-cal>
            </div>
          </div>
        </div>
      </div>
    </div>
  </v-app>
</template>

<script>
import DatePicker from "vue2-datepicker";
import "vue2-datepicker/index.css";
import "vue2-datepicker/locale/pt-br";
import Swal from 'sweetalert2'
import VueCal from "vue-cal";
import "vue-cal/dist/i18n/pt-br.js";
import "vue-cal/dist/vuecal.css";
import { mdiAccount } from "@mdi/js";

window.Swal = Swal
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
}) 
window.Toast = Toast

var lunch = { from: 12 * 60,to: 13 * 60,class: 'lunch' }

export default {
  components: {
    DatePicker,
    VueCal
  },
  data() {
    return {
      record: {
        title: "",
        content: "",
        startDate: "",
        startTime: "",
        endTime: "",
        weekInterval: 1,
        recurrence: "0",
      },
      events: [],
      specialHours: {
        7: { from: 0 * 60,
             to: 23 * 60,
             class: 'event-closed'
        },
        1: lunch,
        2: lunch,
        3: lunch,
        4: lunch,
        5: lunch,
        6: lunch
      },
      configDatePicker: {
        lang: {
          formatLocale: {
            firstDayOfWeek: 1,
          }
        }
      },
      hours: Array.from({ length: 15 }).map((_, i) => i + 8),
      selectedDate: null,
    };
  },
  methods: {
    async loadSchedules() {
      await axios.get("/api/schedule").then((data) => (this.events = data.data));
    },
    disableTime(date) {
      return date.getHours() < 8;
    },
    async createRecord(data) {
      await axios.post(`/api/schedule`, data).then(() => {
        Toast.fire({
          icon: "success",
          title: "Evento cadastrado com sucesso",
        });
        this.record = {};
        this.record = {weekInterval: 1, recurrence: "0"}
      });
      this.loadSchedules();
    },
    async changeView(event) {
      await axios.get("/api/schedule", {
        params: {
          event: event
        }
      }).then((data) => (this.events = data.data));
    }
  },
  created: function () {
    this.loadSchedules();
  },
};
</script>

<style>
.event-closed {
  background-color: rgba(255, 255, 0, 0.2);
  border: solid rgba(255, 210, 0, 0.6);
  border-width: 2px 0;
}
.lunch {
  background-color: rgba(25, 24, 37, 0.2);
  border: solid rgba(40, 40, 51, 0.6);
  border-width: 2px 0;
  display: flex;
  justify-content: center;
  align-items: center;
}

.lunch:before {
  content: 'Almoço';
}
</style>