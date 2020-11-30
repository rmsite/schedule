<template>
  <v-app>
    <v-main>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-12">
            <div class="card">
              <a
                class="btn"
                href="/"
                style="
                  background-color: #42b983;
                  color: white;
                  border-radius: 0;
                "
                >Retornar</a
              >
              <vue-cal
                :events="events"
                active-view="week"
                locale="pt-br"
                :time-from="7 * 60"
                :time-to="20 * 60"
                class="vuecal--green-theme"
                :disable-views="['years', 'year']"
                :on-event-click="onEventClick"
                :on-event-dblclick="createEvent"
                :time-cell-height="60"
                @view-change="changeView($event)"
                :special-hours="specialHours"
              />
            </div>
          </div>
        </div>
      </div>

      <v-dialog v-model="showDialog" class="mx-auto" max-width="400">
        <v-card elevation="2" class="mx-auto" max-width="400">
          <v-card-title>
            <v-icon>{{ selectedEvent.icon }}</v-icon>
            <span>{{ selectedEvent.title }}</span>
            <v-spacer />
            <strong>{{
              selectedEvent.start && selectedEvent.start.format("DD/MM/YYYY")
            }}</strong>
          </v-card-title>
          <v-card-text>
            <p v-html="selectedEvent.content" />
            <strong>Detalhes da Agenda:</strong>
            <ul>
              <li>
                O evento terá início às:
                {{ selectedEvent.start && selectedEvent.start.formatTime() }}
              </li>
              <li>
                O evento será finalizado às:
                {{ selectedEvent.end && selectedEvent.end.formatTime() }}
              </li>
            </ul>
          </v-card-text>
        </v-card>
      </v-dialog>
    </v-main>
  </v-app>
</template>

<script>
import VueCal from "vue-cal";
import "vue-cal/dist/i18n/pt-br.js";
import "vue-cal/dist/vuecal.css";
import { mdiAccount } from "@mdi/js";

const dailyHours = { from: 9 * 60, to: 10 * 60, class: 'event-closed' }

export default {
  components: { VueCal },

  data: () => ({
    selectedEvent: {},
    showDialog: false,
    events: [],
    specialHours: {
      1: dailyHours,
      2: dailyHours,
      3: dailyHours,
      4: dailyHours,
      5: dailyHours
    }
  }),
  methods: {
    async loadSchedules() {
      await axios.get("api/schedule").then((data) => (this.events = data.data));
    },
    onEventClick(event, e) {
      this.selectedEvent = event;
      this.showDialog = true;

      e.stopPropagation();
    },
    createEvent(event, e) {
      alert('cadastrar');
    },
    async changeView(event) {
      await axios.get("api/schedule", {
        params: {
          event: event
        }
      }).then((data) => (this.events = data.data));
    }
  },
  computed: {
    filteredEvents() {
        console.log('passei aqui');
      return this.allEvents.filter(
        (event) => event.start.getTime() >= new Date().getTime()
      );
    },
  },
  created: function () {
    this.loadSchedules();
  },
};
</script>

<style>
.vuecal__event {
  cursor: pointer;
  background-color: #ee9;
}

.vuecal__event-title {
  font-size: 1.2em;
  font-weight: bold;
  margin: 4px 0 8px;
}

.vuecal__event-time {
  display: inline-block;
  margin-bottom: 12px;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(0, 0, 0, 0.2);
}

.vuecal__event-content {
  font-style: italic;
}
.vuecal__event.scheduled {
  background-color: #fdfcdc;
}

/*Custom colors */
.vuecal__bg {
  background-color: #283618;
  color: white;
}
.vuecal__event.blocked {
  background: repeating-linear-gradient(
    45deg,
    transparent,
    transparent 10px,
    #f2f2f2 10px,
    #f2f2f2 20px
  ); /* IE 10+ */
  color: #999;
  display: flex;
  justify-content: center;
  align-items: center;
}
.vuecal__event.blocked .vuecal__event-time {
  display: none;
  align-items: center;
}

/* Green-theme. */
.vuecal__menu,
.vuecal__cell-events-count {
  background-color: #563d7c !important;
}
.vuecal__title-bar {
  background-color: #e4f5ef;
}
.vuecal__cell--today,
.vuecal__cell--current {
  background-color: rgba(240, 240, 255, 0.4);
}
.vuecal:not(.vuecal--day-view) .vuecal__cell--selected {
  background-color: rgba(235, 255, 245, 0.4);
}
.vuecal__cell--selected:before {
  border-color: rgba(66, 185, 131, 0.5);
}
/* Cells and buttons get highlighted when an event is dragged over it. */
.vuecal__cell--highlighted:not(.vuecal__cell--has-splits),
.vuecal__cell-split--highlighted {
  background-color: rgba(195, 255, 225, 0.5);
}
.vuecal__arrow.vuecal__arrow--highlighted,
.vuecal__view-btn.vuecal__view-btn--highlighted {
  background-color: rgba(136, 236, 191, 0.25);
}

.event-closed {
  background-color: rgba(255, 255, 0, 0.2);
  border: solid rgba(255, 210, 0, 0.6);
  border-width: 2px 0;
}
</style>