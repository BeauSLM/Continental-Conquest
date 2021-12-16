from rest_framework import viewsets, permissions
from api.serializers import *
from api.models import *

# Create your views here.
class PlayerViewSet(viewsets.ModelViewSet):
    queryset = Players.objects.all() 
    serializer_class = PlayersSerializer
