def selection_sort(arr):
    n = len(arr)
    for i in range(n):
        # Temukan indeks elemen terkecil dari i hingga akhir
        min_index = i
        for j in range(i + 1, n):
            if arr[j] < arr[min_index]:
                min_index = j
        # Tukar elemen
        arr[i], arr[min_index] = arr[min_index], arr[i]
    return arr

def linear_search(arr, target):
    for i in range(len(arr)):
        if arr[i] == target:
            return i  # indeks ditemukan
    return -1  # tidak ditemukan

# Input dari pengguna
input_str = input("Masukkan angka, pisahkan dengan koma (misal: 5,2,9,1): ")
target = int(input("Masukkan angka yang ingin dicari: "))

# Konversi string input menjadi list integer
data = list(map(int, input_str.split(',')))

# Proses
sorted_data = selection_sort(data.copy())
found_index = linear_search(sorted_data, target)

# Output
print("\nData setelah diurutkan:", sorted_data)
if found_index != -1:
    print(f"Angka {target} ditemukan di indeks ke-{found_index}")
else:
    print(f"Angka {target} tidak ditemukan")
