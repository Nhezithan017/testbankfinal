@extends('layouts.app')

@section('content')
<v-app>
  <v-container>
      <b-jumbotron header="iQueTestBank v1.0" lead="Bootstrap v4 Components for Vue.js 2">
          <p>For more information visit website</p>
          <b-button variant="primary" href="#">More Info</b-button>
        </b-jumbotron>
        <div>
            <b-tabs content-class="mt-3" fill>
              <b-tab title="ABOUT US" active><p>I'm the first tab</p>
                <div>
                    <b-card
                      overlay
                      img-src="https://picsum.photos/900/250/?image=3"
                      img-alt="Card Image"
                      text-variant="white"
                      title="Image Overlay"
                      sub-title="Subtitle"
                    >
                      <b-card-text>
                        Some quick example text to build on the card and make up the bulk of the card's content.
                      </b-card-text>
                    </b-card>
                  </div>
              </b-tab>
              <b-tab title="CONTACT"><p>I'm the second tab</p></b-tab>
              <b-tab title="DEVELOPER INFO"><p>I'm the tab with the very, very long title</p>
                <div>
                    <b-card
                      title="Card Title"
                      img-src="https://picsum.photos/600/300/?image=25"
                      img-alt="Image"
                      img-top
                      tag="article"
                      style="max-width:50%"
                      class="mb-2"
                    >
                      <b-card-text>
                        Some quick example text to build on the card title and make up the bulk of the card's content.
                      </b-card-text>
                  
                      <b-button href="#" variant="primary">Go somewhere</b-button>
                    </b-card>
                  </div>
              </b-tab>
            </b-tabs>
          </div>
  </v-container>
</v-app>
 
@endsection
