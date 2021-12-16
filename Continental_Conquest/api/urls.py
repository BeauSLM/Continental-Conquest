from django.urls import include, path
from api import views

urlpatterns = [
    path(r'^api/player', views.player_list),
]
